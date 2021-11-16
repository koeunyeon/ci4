<form method="POST">
    <select name="sports">
    <?php foreach ($sports_data as $sports_key => $sports_name) : ?>
        <option value="<?= $sports_key ?>" <?= $selected == $sports_key ? "selected='selected'" : '' ?> >
            <?= $sports_name ?>
        </option>
    <?php endforeach; ?>
    </select>
    <p><input type="submit" value="확인"/></p>
</form>