<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */


use Goteo\Library\Text;

?>
<script type="text/javascript">

jQuery(document).ready(function ($) {

    $('#faq-section').change(function () {
        order = $.ajax({async: false, url: '<?php echo SITE_URL; ?>/ws/get_faq_order/'+$('#faq-section').val()}).responseText;
        $('#faq-order').val(order);
        $('#faq-num').html(order);
    });

});
</script>
<div class="widget board">
    <form method="post" action="/admin/faq/?filter=<?php echo $this['filter']; ?>">

        <input type="hidden" name="action" value="<?php echo $this['action']; ?>" />
        <input type="hidden" name="id" value="<?php echo $this['faq']->id; ?>" />

        <p>
        <?php if ($this['action'] == 'add') : ?>
            <label for="faq-section">Sección:</label><br />
            <select id="faq-section" name="section">
                <option value="" disabled>Elige la sección</option>
                <?php foreach ($this['sections'] as $id=>$name) : ?>
                <option value="<?php echo $id; ?>"<?php if ($id == $this['faq']->section) echo ' selected="selected"'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        <?php else : ?>
            <label for="faq-section">Sección: <?php echo $this['sections'][$this['faq']->section]; ?></label><br />
            <input type="hidden" name="section" value="<?php echo $this['faq']->section; ?>" />
        <?php endif; ?>
        </p>

        <p>
            <label for="faq-title">Título:</label><br />
            <input type="text" name="title" id="faq-title" value="<?php echo $this['faq']->title; ?>" />
        </p>

        <p>
            <label for="faq-description">Descripción:</label><br />
            <textarea name="description" id="faq-description" cols="60" rows="10"><?php echo $this['faq']->description; ?></textarea>
        </p>

        <p>
            <label for="faq-order">Posición:</label><br />
            <select name="move">
                <option value="same" selected="selected" disabled>Tal cual</option>
                <option value="up">Antes de </option>
                <option value="down">Después de </option>
            </select>&nbsp;
            <input type="text" name="order" id="faq-order" value="<?php echo $this['faq']->order; ?>" size="4" />
            &nbsp;de&nbsp;<span id="faq-num"><?php echo $this['faq']->cuantos; ?></span>
        </p>


        <input type="submit" name="save" value="Guardar" />
    </form>
</div>