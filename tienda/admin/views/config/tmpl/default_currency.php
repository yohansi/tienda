<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $row = @$this -> row; ?>

<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_SET_DATE_FORMAT_ACT'); ?>
            </th>
            <td><input name="date_format_act" value="<?php echo $this -> row -> get('date_format_act', 'D, d M Y, h:iA'); ?>" type="text" size="40" />
            </td>
            <td><?php echo JText::_('COM_TIENDA_CONFIG_SET_DATE_FORMAT_ACT'); ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_SET_DATE_FORMAT'); ?>
            </th>
            <td><input name="date_format" value="<?php echo $this -> row -> get('date_format', '%a, %d %b %Y, %I:%M%p'); ?>" type="text" size="40" />
            </td>
            <td><?php echo JText::_('COM_TIENDA_CONFIG_SET_DATE_FORMAT'); ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_SELECT_DEFAULT_CURRENCY_FOR_DB_VALUES'); ?>
            </th>
            <td><?php echo TiendaSelect::currency($this -> row -> get('default_currencyid', '1'), 'default_currencyid'); ?>
            </td>
            <td><?php echo JText::_('COM_TIENDA_CONFIG_DEFAULT_CURRENCY'); ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_AUTO_UPDATE_EXCHANGE_RATES'); ?>
            </th>
            <td><?php  echo TiendaSelect::btbooleanlist('currency_exchange_autoupdate', 'class="inputbox"', $this -> row -> get('currency_exchange_autoupdate', '1')); ?>
            </td>
            <td><?php echo JText::_('COM_TIENDA_AUTO_UPDATE_EXCHANGE_RATES_DESC'); ?>
            </td>
        </tr>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_DIMENSIONS_MEASURE_UNIT'); ?>
            </th>
            <td><input type="text" name="dimensions_unit" value="<?php echo $this -> row -> get('dimensions_unit', ''); ?>" />
            </td>
            <td></td>
        </tr>
        <tr>
            <th style="width: 25%;"><?php echo JText::_('COM_TIENDA_WEIGHT_MEASURE_UNIT'); ?>
            </th>
            <td><input type="text" name="weight_unit" value="<?php echo $this -> row -> get('weight_unit', ''); ?>" />
            </td>
            <td></td>
        </tr>
    </tbody>
</table>
