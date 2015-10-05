<?php
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;

/**
 *
 * @param $date
 * @param $for
 * @return string
 */
function convertDate($date, $for = NULL)
{
    if (!$date) {
        return;
    }
    $date = Carbon::createFromFormat('Y-m-d', $date);
    switch($for) {
        case "sql":
            return $date->format('Y-m-d');
            break;
        default:
            return $date->format('d/m/y');
            break;
    }
}

/**
 *
 * @param $resource
 */
function transform($resource)
{
    $manager = new Manager();
    $manager->setSerializer(new DataArraySerializer);

    $manager->parseIncludes(request()->get('includes', []));

//    return $manager->createData($resource);
    return $manager->createData($resource)->toArray();
}

/**
 *
 * @param $model
 * @param TransformerAbstract $transformer
 * @param null $key
 * @return Collection
 */
function createCollection($model, TransformerAbstract $transformer, $key = null)
{
    return new Collection($model, $transformer, $key);
}

?>