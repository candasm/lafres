# Lafres(Laravel 5 Form Request Sanitizer)


#### Why I create this package?
Sanitizer support does not exists anymore on laravel framework. Actually which is not necessary when there is a validation for form inputs.
But when you want a simple functionality for form filtering ups! There is nothing to do rather then write a few lines.

#### What it does?
Removes form keys which are not returning from rules method.  

#### Install

```
$ composer require candasm/laravel-form-request-sanitizer
```

#### How to use it?

Just add trait in your application abstract Request class. 

```php
<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Candasm\Lafres\SanitizeWhenResolvedTrait;

abstract class Request extends FormRequest {
	use SanitizeWhenResolvedTrait;
	
	//
}

```

Add simple interface for your FormRequest classes
```php
<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Candasm\Lafres\SanitizeFormRequest;

class StoreBlogPostRequest extends Request implements SanitizeFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
    }
}
```
