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