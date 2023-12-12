<?php


namespace App\Http\Rule;


use App\Models\Source;
use Illuminate\Contracts\Validation\Rule;

class PreferenceValidation implements Rule
{
    public function __construct(private $type)
    {

    }

    public function passes($attribute, $value)
    {
        $query = new Source;
        if($this->type == 'category'){
            $results = $query->where('category', $value)->exists();
        }elseif ($this->type == 'author'){
            $results = $query->where('author', $value)->exists();
        }elseif ($this->type == 'source'){
            $results = $query->where('reference', $value)->exists();
        }
        return $results;

    }

    public function message()
    {
        return 'The selected preference is invalid.';
    }
}
