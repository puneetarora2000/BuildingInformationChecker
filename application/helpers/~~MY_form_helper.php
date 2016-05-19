<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter HTML5 Form Helpers
 *
 * @package  	CodeIgniter
 * @subpackage	HTML5 Form Helpers
 * @category	Helpers
 * @author 		Phillip Jackson
 */

// ------------------------------------------------------------------------

/**
 * Date Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_date'))
{
	function form_date($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'date', 
			'name' => (( ! is_array($data)) ? $data : ''), 
			'value' => $value
			);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

/**
 * Email Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_email'))
{
	function form_email($data = '', $value = '', $placeholder = '', $extra = '')
	{
		$defaults = array(
			'type' => 'email',
			'name' => (( ! is_array($data)) ? $data : ''), 
			'value' => $value, 
			'placeholder' => $placeholder
			);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

/**
 * Number Field
 * 
 * @access public
 * @param	mixed
 * @param	int
 * @param	int
 * @param	int
 * @return	int
 */
if( ! function_exists('form_number'))
{
	function form_number($data = '', $value = '', $min = '', $max = '', $step = '', $extra = '')
	{
		$defaults = array(
			'type' => 'number', 
			'name' => (( ! is_array($data)) ? $data : ''), 
			'value' => $value,
			'min' => $min,
			'max' => $max,
			'step' => $step
			);
		return "<input " . _parse_form_attributes($data, $defaults) . $extra . "/>";
	}
}

/**
 * Range Field
 * 
 * @access public
 * @param	mixed
 * @param	int
 * @param	int
 * @param	int
 * @return	int
 */
if( ! function_exists('form_range'))
{
	function form_range($data = '', $value = '', $min = '', $max = '', $step = '', $extra = '')
	{
		$defaults = array(
			'type' => 'range', 
			'name' => (( ! is_array($data)) ? $data : ''), 
			'value' => $value,
			'min' => $min,
			'max' => $max,
			'step' => $step
			);
		return "<input " . _parse_form_attributes($data, $defaults) . $extra . "/>";
	}
}

/**
 * File Upload Field
 *
 * @access  public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_file'))
{
	function form_file($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'file', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}