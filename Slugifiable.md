# Slugifiable

Le trait permet d'utiliser des urls de type `{slug}-{id}` (pour le moment ;))



## Configuration minimum

> :warning: **ATTENTION** : Une méthode `getUrlAttribute()` permettra de générer l'url d'un objet slugifiable, veuillez ne pas la surcharger.

### Model

> :information_source: Pour utiliser le trait par défaut, le model doit posséder les attributs `id` et `slug`. Voir la [Configuration Simple](#ConfigurationSimple) ou la [Configuration Avancée](#ConfigurationAvancee) pour modifier ce comportement

```php
use Webup\LaravelTools\Traits\Slugifiable;

class MyModelName
{
    use Slugifiable;

    /**
     * Get the route name for url generation.
     *
     * @return string
     */
    public function getSlugifiableRouteName()
    {
        return "my.route.name";
    }
}
```    

### Router 
```php
Route::get('/{slugifiable}', 'MyController@myMethod')->name('my.route.name');
```

### Controller
> :warning: **ATTENTION** : Le nom du paramètre doit être identique au nom dans le router (ici **$slugifiable**)
```php
    public function myMethod(MyModelName $slugifiable)
    {
        // Have fun !
    }
```



## <a name="Configuration"></a> Configuration simple

L'identifiant utilisé dans l'url est `$model->getKeyName()` (`id` par défaut) et permet de récupérer l'objet dans la DB. 

Pour modifier ce comportement, ajouter au model :
```php
    /**
     * Get the column name for the "id" part of url.
     *
     * @return string
     */
    public function getSlugifiableIdName()
    {
        return "uuid";
    }
```

De la même façon, la partie `slug` de l'url permet de générer le lien et les redirections.

Pour modifier ce comportement, ajouter au model :
```php
    /**
     * Get the column name for the "slug" part of url.
     *
     * @return string
     */
    public function getSlugifiableSlugName()
    {
        return "ref";
    }
```

## <a name="ConfigurationAvancee"></a> Configuration avancée

Il est possible de modifier la query utilisée pour récupérer le model slugifiable. 

```php
    /**
     * Base query used for retreving slugifiable object from DB.
     *
     * @return string
     */
    public function getSlugifiableModelQuery()
    {
        return $this->with([
                        "translations",
                        "images"
                    ])
                    ->where("published", 1);
    }
```
> :warning: **ATTENTION** : si la partie `slug` de l'url se trouve dans une relation du model slugifiable, il sera nécessaire d'ajouter la méthode suivante au model:

```php
    /**
     * Get the object value to fill "slug" part of url.
     *
     * @return string
     */
    public function getSlugifiableSlugValue()
    {
        return $this->translations->first()->slug;
    }
```














