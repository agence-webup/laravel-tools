<?php

namespace Webup\LaravelTools\Traits;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;

trait Slugifiable
{
    /**
     * Route shortcut for creating url.
     *
     * @var string
     */
    protected $slugifiableSlugName = 'slug';

    public static function getObjectOrFail(String $value)
    {
        $exploded = explode('-', $value);
        if (count($exploded) < 2) {
            throw new Exception("Slugifiable url bad format (expected `slug-id`).");
        }

        $id = end($exploded);
        unset($exploded[count($exploded) - 1]);
        $slug = implode("-", $exploded);

        $className = get_called_class();
        $model = new $className();
        if ($model->getSlugifiableRouteName() === null) {
            throw new Exception("Please overide 'getSlugifiableRouteName()' method");
        }

        $query = $model->getSlugifiableModelQuery();

        $object = $query->where($model->getSlugifiableIdName(), $id)->first();
        if ($object === null) {
            return abort(404);
        }

        $objectSlug = $object->getSlugifiableSlugValue();

        if ($objectSlug === null) {
            throw new Exception("Property '" . $model->getSlugifiableSlugName() . "' must not be null. Please override 'getSlugifiableSlugName()' or 'getSlugifiableSlugValue()' methods ");
        }

        if ($objectSlug != $slug) {
            throw new HttpResponseException(new RedirectResponse($object->url, 301));
        }

        return $object;
    }


    /**
     * Base query used for retreving slugifiable object from DB.
     *
     * @return string
     */
    public function getSlugifiableModelQuery()
    {
        return $this;
    }

    /**
     * Get the column name for the "id" part of url.
     *
     * @return string
     */
    public function getSlugifiableIdName()
    {
        return $this->getKeyName();
    }

    /**
     * Get the column name for the "slug" part of url.
     *
     * @return string
     */
    public function getSlugifiableSlugName()
    {
        return $this->slugifiableSlugName;
    }

    /**
     * Get the column name for the "slug" part of url.
     *
     * @return string
     */
    public function getSlugifiableRouteName()
    {
        return null;
    }

    /**
     * Get the object value to fill "slug" part of url.
     *
     * @return string
     */
    public function getSlugifiableSlugValue()
    {
        return $this->{$this->getSlugifiableSlugName()};
    }

    /**
     * Get the slug part for object url.
     *
     * @return string
     */
    public function getSlugifiableSlug()
    {
        return sprintf("%s-%s", $this->getSlugifiableSlugValue(), $this->{$this->getSlugifiableIdName()});
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return self::getObjectOrFail($value);
    }


    /**
     * Get the unique url for the slugifiable object.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route($this->getSlugifiableRouteName(), $this->getSlugifiableSlug());
    }
}
