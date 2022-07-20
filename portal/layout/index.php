<?php

include('../../config/NaiveBayes.php');
/*
$SAMPLES = [[5, 1, 1], [1, 5, 1], [1, 2, 5]];
$LABELS = ['a', 'b', 'c'];

$TEST = [3, 1, 1];
*/
/*
$SAMPLES = [0, 1, 2, 1, 1];
$LABELS = ['Good', 'Bad', 'Good', 'Bad', 'Good'];
$TEST = [1];
*/

$conn = new mysqli("localhost", "root", "", "gizi");

function BMIWithLabel($mass, $height)
{
    $heightToMeters = $height / 100;
    $BMI = $mass / ($heightToMeters ** 2);

    if ($BMI <= 18.5) {
        $messageBMI = "UNDERWEIGHT";
    } else if ($BMI > 17 && $BMI <= 23) {
        $messageBMI = "NORMAL WEIGHT";
    } else if ($BMI > 23 && $BMI <= 27) {
        $messageBMI = "OVERWEIGHT";
    } else if ($BMI > 27) {
        $messageBMI = "OBESE";
    }

    return $messageBMI;
}

$query = mysqli_query($conn, "SELECT * FROM dataset");
$datasetNormal = array();
$SAMPLES = array();
$LABELS = array();

//Mengambil dataset di database
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $datasetNormal[] = [
            $data['tb'],
            $data['bb'],
            $data['nama'],
            $data['nik'],
        ];

        $SAMPLES[] = [
            $data['tb'],
            $data['bb']
        ];

        $LABELS[] = BMIWithLabel($data['bb'], $data['tb']);
    }
}

$TEST = array();

for ($i = 0; $i < 139; $i++) {
    $TEST[] = [
        $SAMPLES[$i][0],
        $SAMPLES[$i][1],
    ];
}


// print_r("<pre>" . print_r($TEST, true) . "</pre>");
/*
$SAMPLES = [['Sunny', 'Hot', 'High', 'Weak'], ['Sunny', 'Hot', 'High', 'Strong'], ['Overcast', 'Hot', 'High', 'Weak']
			, ['Rain', 'Mild', 'High', 'Weak'], ['Rain', 'Cool', 'Normal', 'Weak'], ['Rain', 'Cool', 'Normal', 'Strong']
			, ['Overcast', 'Cool', 'Normal', 'Strong'], ['Sunny', 'Mild', 'High', 'Weak'], ['Sunny', 'Cool', 'Normal', 'Weak']
			, ['Rain', 'Mild', 'Normal', 'Weak'], ['Sunny', 'Mild', 'Normal', 'Strong'], ['Overcast', 'Mild', 'High', 'Strong']
			, ['Overcast', 'Hot', 'Normal', 'Weak'], ['Rain', 'Mild', 'High', 'Strong']];
$LABELS = ['No', 'No', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No'];
$TEST = ['Sunny', 'Cool', 'High', 'Strong'];
*/

for ($i = 0; $i < 139; $i++) {
    $NB = new NaiveBayesClassification();
    $NB->train($SAMPLES, $LABELS);
    $PREDICTED[] = $NB->predict($TEST[$i]);
    // echo "<br>";
    // echo $PREDICTED;
}
print("<pre>" . print_r($PREDICTED, true) . "</pre>");
