<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'productcategory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'created_at', 'updated_at'];
    protected $useTimestamps = false;
}
