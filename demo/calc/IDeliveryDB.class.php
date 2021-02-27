<?php
/**
*	inerface IDeliveryDB
*		содержит основные методы для работы с записями о перевозчике
*/
interface IDeliveryDB{
	/**
	*	Добавление новой записи о перевозчике в бд
	*	
	*	@param string $name - Наименование перевозчика
	*	@param string $price - Цена за перевозку
	*	@param string $more - От сколки кг
	*	@param string $more_price - Цена от сколки кг
	*	
	*	@return boolean - результат успех/ошибка
	*/
	function saveDelivery($name, $price, $more, $more_price);
	/**
	*	Выборка всех записей о перевозчике из бд
	*	
	*	@return array - результат выборки в виде массива
	*/
	function getDelivery();
	/**
	*	Удаление записи о перевозчике из бд
	*	
	*	@param integer $id - идентификатор удаляемой записи
	*	
	*	@return boolean - результат успех/ошибка
	*/
	function deleteDelivery($id);
}
?>