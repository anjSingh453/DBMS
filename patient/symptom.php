
<?php
// Define symptoms and corresponding doctors/specialists
$symptom_doctor_map = array(
    "headache" => "Neurologist",
    "fever" => "General Practitioner",
    "cough" => "Pulmonologist",
    // Add more symptoms and corresponding doctors/specialists as needed
);

// Get user input
if(isset($_POST['symptoms'])) {
    $user_symptoms = strtolower($_POST['symptoms']);
    
    // Process user input
    $user_symptoms_array = explode(",", $user_symptoms); // Assuming symptoms are comma-separated
    
    // Match symptoms to doctors/specialists
    $matched_doctors = array();
    foreach($user_symptoms_array as $symptom) {
        $symptom = trim($symptom); // Remove leading/trailing whitespace
        if(isset($symptom_doctor_map[$symptom])) {
            $matched_doctors[] = $symptom_doctor_map[$symptom];
        }
    }
    
    // Display matched doctors/specialists
    if(!empty($matched_doctors)) {
        echo "Based on your symptoms, you may need to consult the following doctor/specialist(s):<br>";
        foreach($matched_doctors as $doctor) {
            echo "- " . $doctor . "<br>";
        }
    } else {
        echo "No matching doctor/specialist found for the entered symptoms.";
    }
}
?>