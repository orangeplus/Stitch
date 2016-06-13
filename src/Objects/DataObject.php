<?php
namespace orangeplus\Stitch\Objects;

use orangeplus\Stitch\Client;

abstract class DataObject
{
    /** @var string */
    protected static $endPoint;
    protected static $detailEndPoint;
    protected static $collectionName;
    protected static $readRequest = ['action' => 'read', 'page_num' => 1, 'page_size' => 5];

    public static function fetchList(Client $client, $params)
    {
        $request = static::$readRequest;
        $fetched = $client->post(static::$endPoint, $request);
        $objects = $fetched->{static::$collectionName};
        $result = [];
        while ($obj = array_pop($objects)){
            $result[] = static::cast($obj);
        }
        return $result;
    }

    public static function fetchById($id)
    {

    }

    public function cast(\stdClass $source)
    {
        // create a new one of me
        $className = get_called_class();
        $me = new $className();
        // get the properties of the source
        $reflection = new \ReflectionObject($source);
        $properties = $reflection->getProperties();
        // go over each
        foreach ($properties as $property) {
            $name = $property->getName();
            // if this is an object, recurse
            if (is_object($source->{$name})) {
                $newClassName = __NAMESPACE__.'\\'.ucfirst($name);
                // in order to recurse, it must extend Results, otherwise cast it to an
                // array
                if (is_subclass_of($newClassName, __NAMESPACE__.'\\'.'Results')) {
                    $me->{$name} = $newClassName::cast($source->{$name});
                } else {
                    $me->{$name} = (array)$source->{$name};
                }
            } else {
                $me->{$name} = $source->$name;
            }
        }
        return $me;
    }
}