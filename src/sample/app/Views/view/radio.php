<form method="POST">
    <?php foreach ($sports_data as $sports_key => $sports_name) : ?>
        <?= $sports_name ?>
        <input type="radio" name="sports" value="<?= $sports_key ?>" <?= $checked == $sports_key ? "checked='checked'" : '' ?> />
    <?php endforeach; ?>
    <p><input type="submit" value="확인"/></p>
</form>