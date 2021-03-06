<div class="container">
<div class="row">
    <div class="col-md-4 col-xs-12">
    </div>
    <div class="col-md-4 col-xs-12">
        <?php

        /**
         *
         * Modify user form view, User info
         *
         * @package	VirtueMart
         * @subpackage User
         * @author Oscar van Eijk, Eugen Stranz
         * @link http://www.virtuemart.net
         * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
         * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
         * VirtueMart is free software. This version may have been modified pursuant
         * to the GNU General Public License, and as distributed it includes or
         * is derivative of works licensed under the GNU General Public License or
         * other free or open source software licenses.
         * @version $Id: edit_address_userfields.php 6349 2012-08-14 16:56:24Z Milbo $
         */
        // Check to ensure this file is included in Joomla!
        defined('_JEXEC') or die('Restricted access');

        // Status Of Delimiter
        $closeDelimiter = false;
        $openTable = true;
        $hiddenFields = '';

        // Output: Userfields
        foreach($this->userFields['fields'] as $field) {

            if($field['type'] == 'delimiter') {

                // For Every New Delimiter
                // We need to close the previous
                // table and delimiter
                if($closeDelimiter) { ?>
                    </table>
                </fieldset>
                <?php
                $closeDelimiter = false;
                } //else {
                    ?>
                    <fieldset>
                    <span class="userfields_info"><?php echo $field['title'] ?></span>

                    <?php
                    $closeDelimiter = true;
                    $openTable = true;
                //}
            } elseif ($field['hidden'] == true) {

                // We collect all hidden fields
                // and output them at the end
                $hiddenFields .= $field['formcode'] . "\n";

            } else {

                // If we have a new delimiter
                // we have to start a new table
                if($openTable) {
                    $openTable = false;
                    ?>

                    <table  class="adminForm user-details">

                <?php
                }

                // Output: Userfields
                ?>
                        <tr>
                            <td class="key" title="<?php echo $field['description'] ?>" >
                                <label class="<?php echo $field['name'] ?>" for="<?php echo $field['name'] ?>_field">
                                    <?php echo $field['title'] . ($field['required'] ? ' *' : '') ?>
                                </label>
                                <?php if($field['name'] == 'selectlocation'){?>
                                <?php
                                    $prod = unserialize($_SESSION['__vm']['vmcart']);
                                    $arr = $prod->products;
                                    $q = 0;
                                    $array = array();
                                    foreach ($arr as $key => $value) {
                                        $array[$q] = $value;
                                        if($array[$q]->category_name == 'Stock'){
                                            $stcok = true;
                                        }
                                        $q++;
                                    }
                                ?>
                                <?php
                                    if($stcok){
                                        echo '<select id="selectlocation" name="selectlocation" class="vm-chzn-select">
                                                <option value="20">(STOCK) Буюканы, ул. Иона Крянгэ 76, nr. 65, г. Кишинёв</option>
                                            </select>';
                                    }else echo $field['formcode'];
                                } else{ ?>
                                    <?php echo $field['formcode']; ?>
                                <?php }

                                ?>
                            </td>
                        </tr>
            <?php
            }

        }

        // At the end we have to close the current
        // table and delimiter ?>

                    </table>
                </fieldset>

        <?php // Output: Hidden Fields
        echo $hiddenFields
        ?>
        <?php //echo '<pre>'; print_r($array); ?>
        </div>
        <div class="col-md-4 col-xs-12">
        </div>
    </div>
</div>
