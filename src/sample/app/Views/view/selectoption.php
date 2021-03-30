<form method="POST">
    <select name="sports"> <!-- (1) -->
    <?php foreach ($sports_data as $sports_key => $sports_name) : ?>
        <option value="<?= $sports_key ?>" <?= $selected == $sports_key ? "selected='selected'" : '' ?> >  <!-- (2) -->
            <?= $sports_name ?> <!-- (3) -->
        </option>
    <?php endforeach; ?>
    </select> <!-- (4) -->
    <p><input type="submit" value="확인"/></p>
</form>