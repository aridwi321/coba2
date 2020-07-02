<?php

namespace Modules\Article\Entities;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Article\Entities\Presenters\PostPresenter;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Input extends BaseModel  //implements Feedable

{
    use LogsActivity, SoftDeletes, PostPresenter, Notifiable;

    protected $table = 'inputs';

    // protected static $logName = 'inputs';
    // protected static $logOnlyDirty = true;
    // protected static $logAttributes = ['category_id', 'weight'];

    public function category()
    {
        return $this->belongsTo('Modules\Article\Entities\Category');
    }
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = $value;

        try {
            $category = Category::findOrFail($value);
            $this->attributes['category_name'] = $category->name;
        } catch (\Exception $e) {
            $this->attributes['category_name'] = null;
        }
    }
    public function setUserIdAttribute($value){
        $this->attributes['user_id'] = $value;

        try {
            $user = User::findOrFail($value);
            $this->attributes['user_name'] = $user->name;
        } catch (\Exception $e) {
            $this->attributes['user_name'] = null;
        }
    }
}

