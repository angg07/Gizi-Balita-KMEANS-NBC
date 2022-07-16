<?php

class NaiveBayes
{
    private $classes = array();
    private $attribute = array();
    public $trainingSet = array();
    private $params = array();
    private $classField = '';

    public function __construct($classes, $classField, $trainingSet, $params)
    {
        $this->validate($classes, $classField, $trainingSet, $params);

        $this->classField = $classField;
        $this->classes = $classes;
        $this->trainingSet = $trainingSet;
        $this->params = $params;

        $attribute = array_keys($params);
        foreach ($attribute as $attr) {
            $temp = array(
                'name' => $attr,
                'isNumeric' => false,
                'category' => array()
            );

            if (is_numeric($params[$attr])) {
                $temp['isNumeric'] = true;
            } else {

                $col = array_column($trainingSet, $attr);
                foreach ($col as $c) {
                    if (in_array($c, $temp['category'])) {
                        array_push($temp['category'], $c);
                    }
                }
            }

            array_push($this->attribute, $temp);
        }
    }


    private function error($message)
    {
        exit('NaiveBayes validation says: ' . $message);
    }

    private function validate($classes, $classField, $trainingSet, $params)
    {
        if (!is_array($classes) || !is_array($trainingSet) || !is_array($params)) {
            $this->error('$classes, $trainingSet, or $params is not Array!');
        }

        if (empty($classes) || empty($trainingSet) || empty($params)) {
            $this->error('$classes, $trainingSet, or $params is empty!');
        }

        if (!isset($trainingSet[0])) {
            $this->error('$trainingSet is empty!');
        }

        $trainingSetKey = array_keys($trainingSet[0], $classField, true);
        $arrDiff = array_diff($trainingSetKey, array_keys($params));

        if (count($arrDiff) > 0) {
            $this->error('Keys of $trainingSet[0] not equal with keys of $params!');
        }
    }

    /**
     * Get index of property $attribute by it's name
     * @param String $name
     * @return Integer
     * @example $this->findAttributeIndex('temp') => 1
     * @example $this->findAttributeIndex('sdasdsa') => -1
     */
    private function findAttributeIndex($name)
    {
        $findIndex = array_search($name, array_column($this->attribute, 'name'));
        if ($findIndex === false) {
            return -1;
        }
        return $findIndex;
    }

    /**
     * Set category for categorial attribute
     * @param String $attributeName
     * @param Array $category
     *
     * @example $attributeName = 'outlook'
     * @example $category = ['sunny', 'rainy', 'cloudy']
     * @example $naiveBayes->setCategoryOfAttribute($attributeName, $category)
     */
    function setCategoryOfAttribute($attributeName, $category)
    {
        if (!is_array($category)) {
            $this->error('$category must be array!');
        }

        $findIndex = $this->findAttributeIndex($attributeName);
        if ($findIndex < 0) {
            $this->error('Undefined attribute-> ' . $attributeName);
        }

        if ($this->attribute[$findIndex]['isNumeric']) {
            $this->error($attributeName . ' is Numeric Attribute!');
        }

        $this->attribute[$findIndex]['category'] = $category;
    }

    /**
     * Get data of training set by condition, like WHERE clause on MySQL 
     * @param (Associative) Array $attributeName
     * @return (Multidimensional) Array
     *
     * @example $filter = ['outlook' => 'rainy']
     */
    function getTrainingSetByFilter($filter = ['field' => 'value'])
    {
        $trainingSet = $this->trainingSet;
        $result = array();

        for ($i = 0; $i < count($trainingSet); $i++) {
            $check = true;
            foreach ($filter as $field => $value) {
                if ($check) {
                    $check = ($trainingSet[$i][$field] == $value);
                }
            }

            if ($check) {
                array_push($result, $trainingSet[$i]);
            }
        }

        return $result;
    }

    /**
     * Get all parameters was set before
     * @return (Associative) Array
     */
    public function getAllParams()
    {
        return $this->params;
    }

    /**
     * Get X for numerical attribute depends on a Class
     * @param String $attribute
     * @param String $class
     * @return Double
     */
    private function getX($attribute, $class)
    {
        $filter = array($this->classField => $class);
        $dataOnClass = $this->getTrainingSetByFilter($filter);

        $numClass = count($dataOnClass);
        $sum = 0;
        for ($i = 0; $i < count($dataOnClass); $i++) {
            $sum += $dataOnClass[$i][$attribute];
        }

        $result = $sum / $numClass;
        return $result;
    }

    /**
     * Get s^2 for numerical attribute depends on a Class
     * @param String $attribute
     * @param String $class
     * @return Double
     */
    private function getS2($attribute, $class)
    {
        $x = $this->getX($attribute, $class);

        $filter = array($this->classField => $class);
        $dataConditionOnClass = $this->getTrainingSetByFilter($filter);
        $dataConditionOnClass = array_column($dataConditionOnClass, $attribute);

        $sumPower = 0;
        foreach ($dataConditionOnClass as $row) {
            $power = pow($row - $x, 2);
            $sumPower += $power;
        }

        $filter = array($this->classField => $class);
        $dataOnClass = $this->getTrainingSetByFilter($filter);
        $numClass = count($dataOnClass);

        $result = $sumPower / ($numClass - 1);
        return $result;
    }

    /**
     * Get P(X|C) for numerical attribute depends on a Class
     * @param String $attribute
     * @param String $class
     * @return Double
     */
    public function getProbabilityOfNumericConditionOnClass($attribute, $class)
    {
        $twoPhi = 2 * 3.14;
        $s2 = $this->getS2($attribute, $class);
        $front = sqrt($twoPhi * $s2);

        $x = $this->getX($attribute, $class);
        $powS2 = pow($s2, 2);
        $behind = exp(pow($this->params[$attribute] - $x, 2) / (2 * $powS2));

        return 1 / ($front * $behind);
    }

    /**
     * Get P(X|C) for categorial attribute depends on a Class
     * @param String $attribute
     * @param String $class
     * @return Double
     */
    private function getProbabilityCategorialOfConditionOnClass($attribute, $class)
    {
        $filter = array(
            $attribute => $this->params[$attribute],
            $this->classField => $class
        );
        $numConditionOnClass = count($this->getTrainingSetByFilter($filter));

        $filter = array($this->classField => $class);
        $numClass = count($this->getTrainingSetByFilter($filter));

        $result = $numConditionOnClass / $numClass;
        return $result;
    }

    /**
     * Get P(X|C) on a Class by determine the attribute between categorial or numerical
     * @param String $attributeName
     * @param String $class
     * @return Double
     */
    public function getProbabilityOfConditionOnClass($attributeName, $class)
    {
        if (!isset($this->params[$attributeName])) {
            $this->error($attributeName . ' is undefined Attribute!');
        }

        $findIndex = $this->findAttributeIndex($attributeName);
        if ($this->attribute[$findIndex]['isNumeric'] === false) {
            $result = $this->getProbabilityCategorialOfConditionOnClass($attributeName, $class);
        } else {
            $result = $this->getProbabilityOfNumericConditionOnClass($attributeName, $class);
        }

        return $result;
    }

    /**
     * Get P(X|C) for each attribute depends on a Class
     * @param String $class
     * @return Double
     */
    public function getAllProbabilityOfConditionOnClass($class)
    {
        if (!in_array($class, $this->classes)) {
            $this->error('Undefined class->' . $class);
        }

        $result = array();
        $attribute = array_column($this->attribute, 'name');

        foreach ($attribute as $attr) {
            $result[$attr] = $this->getProbabilityOfConditionOnClass($attr, $class);
        }

        return $result;
    }

    /**
     * Get P(C) for a Class
     * @param String $class
     * @return Double
     */
    public function getProbabilityOfClass($class)
    {
        if (!in_array($class, $this->classes)) {
            $this->error('Undefined class->' . $class);
        }

        $filter = array($this->classField => $class);
        $dataOnClass = $this->getTrainingSetByFilter($filter);
        $numClass = count($dataOnClass);

        $numAllData = count($this->trainingSet);

        return $numClass / $numAllData;
    }

    /**
     * Get P(C|X) / Result Probability for each Class
     * @param ? Integer $decimalDigit
     * @return Array
     */
    public function getResultProbabilityOfClassOnCondition($decimalDigit = 20)
    {
        $result = array();
        $attribute = array_column($this->attribute, 'name');

        foreach ($this->classes as $class) {
            $PC = $this->getProbabilityOfClass($class);
            $allPXC = $this->getAllProbabilityOfConditionOnClass($class);

            $result[$class] = $PC;
            foreach ($allPXC as $PXC) {
                $result[$class] *= $PXC;
            }

            $result[$class] = number_format($result[$class], $decimalDigit);
        }

        return $result;
    }

    /**
     * Get Naive Bayes Result / largest Result Probability of each Class
     * @return String
     */
    public function getClassificationResult()
    {
        $allPCX = $this->getResultProbabilityOfClassOnCondition();
        $result = array_search(max($allPCX), $allPCX);

        return ucfirst($result);
    }

    /**
     * Create object by Naive Bayes Class
     * @param (Associative) Array $params
     * @return Object (Naive Bayes)
     *
     * @example $params = [
     * @example   'classes' => $classes,
     * @example   'classField' => $classField,
     * @example   'trainingSet' => $trainingSet,
     * @example   'params' => $params
     * @example ]
     * @example $naiveBayes = NaiveBayes::init($params)
     */
    public static function init($params)
    {
        $valid = array_key_exists('classes', $params) && array_key_exists('classField', $params) && array_key_exists('trainingSet', $params) && array_key_exists('params', $params);
        $valid or exit('NaiveBayes what called need $params["classes", "classField", "trainingSet", "params"] to pass to constructor!');

        return new NaiveBayes($params['classes'], $params['classField'], $params['trainingSet'], $params['params']);
    }
}

class NaiveBayesClassification
{

    private $SAMPLES, $LABELS, $INPUT, $LABELS_SUM, $LEN_SAMPLES_SUB;

    public function __construct()
    {
        $this->SAMPLES = array();
        $this->LABELS = array();
        $this->LABELS_SUM = array();
    }

    public function train($SAMPLES, $LABELS)
    {
        // All multidimension SAMPLES must have the same size
        $SIZE = -1;
        foreach ($SAMPLES as $S) {
            if (count($S) != $SIZE && $SIZE != -1) {
                echo "Error : Uneven SAMPLES size <br>";
                return null;
            }
            $SIZE = count($S);
        }

        // SAMPLES and LABELS must have the same size
        if (count($SAMPLES) != count($LABELS)) {
            echo "Error : Uneven SAMPLES and LABELS size <br>";
            return null;
        }

        // LABELS should not be multidimension
        if (count($LABELS) != count($LABELS, COUNT_RECURSIVE)) {
            echo "Error : LABELS should not be multidimensional <br>";
            return null;
        }

        $this->SAMPLES = $SAMPLES;
        $this->LABELS = $LABELS;

        // Sum of LABELS
        //Menghitung Jumlah Kelas
        foreach ($this->LABELS as $L) {
            if (!array_key_exists($L, $this->LABELS_SUM)) {
                $this->LABELS_SUM[$L] = 0;
            }
            $this->LABELS_SUM[$L]++;
        }

        $SAMPLESAMPLES_PROB = array();
        $LEN_SAMPLES = count($this->SAMPLES);
        // If SAMPLES are multidimension
        //Menghitung Jumlah Kasus Perkelas
        if (count($this->SAMPLES) != count($this->SAMPLES, COUNT_RECURSIVE)) {
            // Calculate the probabilities of SAMPLES
            //Menghitung Kemungkinan Muncul Samples
            $this->LEN_SAMPLES_SUB = count($this->SAMPLES[0]);
            for ($COL = 0; $COL < $this->LEN_SAMPLES_SUB; $COL++) {
                for ($ROL = 0; $ROL < $LEN_SAMPLES; $ROL++) {
                    $SAMPLES_PROB = $COL . "_" . $this->SAMPLES[$ROL][$COL];
                    if (!isset($this->$SAMPLES_PROB)) {
                        $this->$SAMPLES_PROB = array_fill_keys(array_keys($this->LABELS_SUM), 0);
                        array_push($SAMPLESAMPLES_PROB, $SAMPLES_PROB);
                    }
                    $this->$SAMPLES_PROB[$this->LABELS[$ROL]]++;
                }
            }

            //Kalikan Semua Variable Kelas
            foreach ($SAMPLESAMPLES_PROB as $SAMPLES_PROB) {
                // echo $SAMPLES_PROB . "&emsp;";
                // print_r($this->$SAMPLES_PROB);

                foreach ($this->$SAMPLES_PROB as $KEY => $VALUE) {
                    $this->$SAMPLES_PROB[$KEY] /= $this->LABELS_SUM[$KEY];
                }

                // print_r($this->$SAMPLES_PROB);
                // echo "<br>";
            }
        }
        // If SAMPLES are single array
        else {
            $this->LEN_SAMPLES_SUB = count($this->SAMPLES);
            for ($I = 0; $I < $this->LEN_SAMPLES_SUB; $I++) {
                $SAMPLES_PROB = $this->SAMPLES[$I];
                if (!isset($this->$SAMPLES_PROB)) {
                    $this->$SAMPLES_PROB = array_fill_keys(array_keys($this->LABELS_SUM), 0);
                    array_push($SAMPLESAMPLES_PROB, $SAMPLES_PROB);
                }
                $this->$SAMPLES_PROB[$this->LABELS[$I]]++;
            }

            foreach ($SAMPLESAMPLES_PROB as $SAMPLES_PROB) {
                echo $SAMPLES_PROB . "&emsp;";
                print_r($this->$SAMPLES_PROB);

                foreach ($this->$SAMPLES_PROB as $KEY => $VALUE) {
                    $this->$SAMPLES_PROB[$KEY] /= $this->LABELS_SUM[$KEY];
                }

                // print_r($this->$SAMPLES_PROB);
                // echo "<br>";
            }
        }
    }

    public function predict($INPUT)
    {
        // INPUT should not be multidimension
        if (count($INPUT) != count($INPUT, COUNT_RECURSIVE)) {
            echo "Error : INPUT should not be multidimensional <br>";
            return null;
        }

        // SAMPLES and INPUT must have the same size
        if (count($this->SAMPLES) != count($this->SAMPLES, COUNT_RECURSIVE)) {
            if ($this->LEN_SAMPLES_SUB != count($INPUT)) {
                echo "Error : Uneven SAMPLES and INPUT size <br>";
                return null;
            }
        } else {
            if (count($INPUT) != 1) {
                echo "Error : Invalid INPUT size <br>";
                return null;
            }
        }

        $this->INPUT = $INPUT;
        $LEN_INPUT = count($this->INPUT);
        $PROB_LIST = array();

        //Membandingkan Hasil Per Kelas
        foreach ($this->LABELS_SUM as $KEY => $VALUE) {
            $PROB = 1;
            for ($I = 0; $I < $LEN_INPUT; $I++) {
                (count($this->SAMPLES) != count($this->SAMPLES, COUNT_RECURSIVE)) ?    $SAMPLES_PROB = $I . "_" . $this->INPUT[$I] : $SAMPLES_PROB = $this->INPUT[$I];
                if (isset($this->$SAMPLES_PROB)) {
                    $PROB *= $this->$SAMPLES_PROB[$KEY];
                }
            }
            $PROB *= $this->LABELS_SUM[$KEY] / array_sum($this->LABELS_SUM);
            $PROB_LIST[$KEY] = $PROB;
        }
        $HIGHEST_PROB = array_search(max($PROB_LIST), $PROB_LIST);
        // print("<pre>" . print_r($HIGHEST_PROB, true) . "</pre>");
        return $HIGHEST_PROB;
    }
}
