<?php

    namespace App\Models;


    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;


    class Company extends Model
    {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'title', 'phone', 'description', 'user_id',
        ];

        protected $visible = [ 'title', 'phone', 'description'];


    }
