<?php

function model_array_pluck($models, $value, $key = null)
{
	$result = array();
	if( ! is_array($models)) return $result;
	
	$i = 0;
	foreach ($models as $model)
	{
		$result[is_null($key) ? $model->get_key() : ($key instanceof Closure ? $key($model) : ($key == '' ? $i : $model->$key))] = $value instanceof Closure ? $value($model) : $model->$value;
		$i++;
	}

	return $result;
}

function prefix($for)
{
	return Config::get('layla.'.$for.'.url_prefix').'/';
}

function merge_attributes($array1, $array2)
{
	$array = $array1;
	foreach ($array2 as $key => $value)
	{
		if(array_key_exists($key, $array1))
		{
			$array[$key] = $array1[$key] .= ' '.$array2[$key];
		}
		else
		{
			$array[$key] = $array2[$key];
		}
	}

	return $array;
}