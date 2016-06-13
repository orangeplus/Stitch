<?php
namespace orangeplus\Stitch\Objects;

class Product extends DataObject
{
    protected static $endPoint = 'v2/Products';
    protected static $detailEndPoint = 'v2/Products/detail';
    protected static $collectionName = 'Products';
    protected $id;
    protected $archived;
    protected $committed_stock;
    protected $created_at;
    protected $deleted;
    protected $description;
    protected $local_id;
    protected $low_stock_count;
    protected $name;
    protected $notes;
    protected $total_available;
    protected $total_stock;
    protected $updated_at;
    protected $variant_count;
    
    

}