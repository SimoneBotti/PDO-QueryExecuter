<?

    require_once "Controller.class.php";

    class Record implements JsonSerializable, ArrayAccess
    {

        private $id_name = null;
        private $table = null;
        private $controller = null;
        private $name_controller = "";

        private $container = array();

        //Magical Methods
        public function __construct(array $arrayFromDatabase, string $id = null)
        {
            foreach($arrayFromDatabase as $key => $value)
            {
                $this->$key = $value;
            }

            $this->id_name = $id;
            $this->container = $arrayFromDatabase;
        }

        public function __get(string $property)
        {
            if(property_exists($this, $property))
                if($property === "container")
                    return null;
                else
                    return $this->$property;
            else
                throw new Exception("Unreconized property: $property", 10001);
        }

        public function __sleep(): void
        {
            if(isset($this->controller))
            {
                $this->name_controller = get_class($this->controller);
                $this->controller = null;
            }            
        }

        public function __wakeup(): void
        {
            if($this->name_controller !== "")
            {
                $this->controller = new $name_controller();
                $this->name_controller = "";
            }
        }

        public function __toString(): string
        {
            $result = "";

            foreach($this->container as $key => $value)
            {
                $result .= "$key: $value\n";
            }

            return $result;
        }

        //Array Acess Methods
        public function offsetSet($offset, $value) 
        {
            if (is_null($offset))
                $this->container[] = $value;
            else
                $this->container[$offset] = $value;
        }
    
        public function offsetExists($offset): bool
        {
            return isset($this->container[$offset]);
        }
    
        public function offsetUnset($offset) 
        {
            unset($this->container[$offset]);
        }
    
        public function offsetGet($offset) 
        {
            return isset($this->container[$offset]) ? $this->container[$offset] : null;
        }

        //JsonSerializable Method
        public function jsonSerialize()
        {
            return json_encode($this->container);
        }

        //Class Methods
        public function setController(Controller $controller): void
        {
            $this->controller = $controller;
        }

        public function setTable(string $table): void
        {
            $this->table = $table;
        }

        public function delete(): bool
        {
            if(!isset($this->id_name))
                return false;

            if(!isset($this->controller))
                return false;

            if(!isset($this->table))
                return false;
            
            $sql = "DELETE FROM $this->table WHERE $this->id_name = ?";

            return $this->controller->execute($sql, $this->$this->id_name);
        }

        public function update(string $valueToChange, $newValue): bool
        {
            if(!isset($this->controller))
                return false;

            if(!isset($this->id_name))
                return false;

            if(!isset($this->table))
                return false;

            $sql = "UPDATE $this->table SET $valueToChange = ?";

            return $this->$controller->execute($sql, $newValue);
        }

    }

?>