<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['id','name','description','icon','label','order','active','store_id'];

    //una mesa pertenece a una tienda
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function storeTable($data){        
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->icon = $data['icon'];
        $this->label = $data['label'];
        $this->order = $data['order'];
        $this->active = $data['active'];
        $this->store_id = $data['store_id'];
        $this->save();
    }

    public function icons()
    {
        return [
            'fas fa-users' =>__('form.SelectUsers'),
            'fas fa-beer' =>__('form.SelectBeer'),
            'fas fa-glass-martini' =>__('form.SelectMartini'),
            'fas fa-birthday-cake' =>__('form.SelectCake'),
            'fas fa-coffee'=>__('form.SelectCoffe'),
            'fas fa-dice-d6' => __('form.SelectDice'),
            'fas fa-feather' => __('form.SelectFeather'),
            'fas fa-heart' => __('form.Selectheart'),
            'fas fa-moon' => __('form.SelectMoon'),
            'fas fa-star' => __('form.SelectStar'),
            'fas fa-wine-glass' => __('form.SelectWineGlass'),
            'fas fa-flag' => __('form.SelectFlag'),
            'fas fa-fire' => __('form.SelectFire'),
            'fas fa-clipboard' => __('form.SelectClipboard'),
            'fas fa-bell' => __('form.SelectBell'),
            'fas fa-archive' => __('form.SelectArchive'),
            'fab fa-first-order-alt' => __('form.SelectOrder'),
            'fas fa-cloud' =>__('form.SelectCloud'),
            'fas fa-couch' => __('form.SelectCouch'),
        ];
    }
}
