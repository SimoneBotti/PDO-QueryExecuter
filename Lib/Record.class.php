<?

    require_once "Controller.class.php";

    class Record implements JsonSerializable, ArrayAccess
    {
        private $empty = false;
        private $name_controller = "";

        private $container = array();

        public function __construct()
        {
            $arg = func_get_arg(0);

            if($arg != null && is_array($arg))
            {
                foreach($arg as $key => $value)
                {
                    $this->$key = $value;
                }

                $this->container = $arg;
            }
            elseif($arg == null)
                $this->empty = true;
            else
                throw new Exception("Bad use of constructor", 1000);
        }

        public function __get(string $property)
        {
            if(property_exists($this, $property))
                if($property === "empty" || $property === "container")
                    return null;
                else
                    return $this->$property;
            else
                throw new Exception("Unreconized property: $property", 10001);
        }

        public function __sleep()
        {
            if(property_exists($this, "controller"))
            {
                $this->name_controller = get_class($this->controller);
                $this->controller = null;
            }            
        }

        public function __wakeup()
        {
            if($this->name_controller !== "")
            {
                $this->controller = new $name_controller();
                $this->name_controller = "";
            }
        }

        public function isEmpty(): bool
        {
            return $this->empty;
        }

        

    }


?>