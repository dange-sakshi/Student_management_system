<?php
function validate_input($data){
if (
!isset($data->name) || !isset($data->rollNo) || !isset($data->std) || !isset($data->hindi) || !isset($data->marathi)
|| !isset($data->math) || !isset($data->sci) || !isset($data->history) || !isset($data->cs)
) :

echo json_encode([

'Please fill all the fields .',
]);
exit;

elseif (
empty(trim($data->name)) || empty(trim($data->rollNo)) || empty(trim($data->std)) || empty(trim($data->hindi))
|| empty(trim($data->marathi)) || empty(trim($data->math)) || empty(trim($data->sci)) || empty(trim($data->history)) || empty(trim($data->cs))
) :

echo json_encode([
'Oops! empty field detected. Please fill all the fields.',
]);
exit;

endif;
}
?>