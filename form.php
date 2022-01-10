<?php 

class Form
{
	private $action;
	private $method;
	private $data;
	private $allowedTypes = array('checkbox', 'radio');
	
	public function __construct($action="#", $method="post" , $data=array())
	{
		$this->action = $action;
		$this->method = $method;
		$this->data = $data;
	}

	public function addInput($type="text", $name="test", $label="test", $qst="what?"){
        if(array_key_exists($name, $this->data) === true){
            return;
        }
        $con = in_array($type, $this->allowedTypes);
        	if (!$con){
            	$newInput = array("type" => $type, "label" => $label);
        	} else {
        		$newInput = array("type" => $type, "label" => $label, "qst" => $qst);
        	}
            $this->data[$name] = $newInput;
        }

    public function getHtml(){
		$result = '<form action="'. $this->action . '" method = "' . $this->method . '">';
        foreach($this->data as $name => $inputElement){
        	$con = in_array($inputElement["type"], $this->allowedTypes); 
        	// echo "condition is $con<br>";
        	if (!$con) {
            	$result .= '<p>'.
                	$inputElement["label"] . ' : <input type="' . $inputElement["type"] . '" name="'. $name . '">'
                	.'</p>';
            } else {
            	$result .= '<h3>'.$inputElement["qst"].'</h3>'; 
				foreach($inputElement["label"] as $e) {
                $result .= '<input type="' . $inputElement["type"] . '" name="'. $name . '">'.
                	'<label for='.$name.'>'.$e.'</label><br>';
				}
            }
            }
            $result .= '<button type="submit">Submit</button>';
            $result .= '</form>';
            return $result;
    }

}
	$data = array(
			  "username" => array("type" => "text"    , "label" => "your username"),
              "password" => array("type" => "password", "label" => "your password"),
              "email"    => array("type" => "email"   , "label" => "your email"   ),
              "chbox[]"  => array('type' => "checkbox", "label" => ['v1', 'v2', 'v3'], "qst" => "What is?"),
              "r"  => array('type' => "radio", "label" => ['v1', 'v2', 'v3'], "qst" => "What is?"),
            ) ;
	$form2 = new Form("#", "get", $data);
	$form = new Form();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Form POO</title>
</head>
<body>
	<h1>First Form: Adding inputs every time:</h1>
    <?php
        $form->addInput("text", "username", "your username");
        $form->addInput("password", "password", "your password");
        $form->addInput("checkbox", "chbox[]", ["v1", "v2"], "What is?");
        $form->addInput("checkbox", "chbox[]", ["v1", "v2"], "Where is?"); // It will no work because already exist !
        $form->addInput("radio", "r", ["v1", "v2"], "When ?");
        echo $form->getHtml();
    ?>
	<h1>Second Form: Directly from Data</h1>
	<?php 
	echo $form2->getHtml();
	?>
</body>
</html>