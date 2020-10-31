<?php
class Form
{
    private static $INSTANCE;

    /** 
     * formData = receive all of data request
     */
    private $formData;
    private $tempFormColumnName;
    private $invalidInputForm;
    private $isAnyInvalid = TRUE;

    public static function new()
    {
        if (self::$INSTANCE == null)
            self::$INSTANCE = new Form();
        return self::$INSTANCE;
    }
    /**
     * String columnName = Column in database name
     * String inputName  = Field name from input form(html)
     */
    public function post($columnName, $inputName)
    {
        $this->formData[$columnName] = Input::post($inputName);
        $this->tempFormColumnName = $columnName;
        return $this;
    }
    public function required()
    {
        $columnName = $this->tempFormColumnName;
        $valueForm = $this->formData[$columnName];
        $isValid = !string_empty_or_null($valueForm);
        
        $this->invalidInputForm[$columnName] = $isValid;
        $this->setAnyInvalid($isValid);

        return $this;
    }

    private function setAnyInvalid($bool){
        if ($this->isAnyInvalid && $bool == FALSE)
            $this->isAnyInvalid = $bool;
    }
    // if any invalid input then return FALSE.
    public function submit()
    {
        if (!$this->isAnyInvalid)
            return $this->isAnyInvalid;
        else
            return $this->formData;
    }
}
