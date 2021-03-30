<form method="POST">
    <h3>1개짜리 체크박스</h3>
    <p>
        스포츠를 좋아하나요?        
        <input type="checkbox" name="sports_like" value="Y" <?= $sports_like ? "checked='checked'" : '' ?> /> 
    </p>
    <hr />
    <h3>여러개 체크박스</h3>
    <p>
    <ul>        
        <?php foreach ($sports_data as $sports_key => $sports_name) : ?>
            <li>
                <?= $sports_name ?>                
                <input type="checkbox" name="sports_name[]"  value="<?= $sports_key ?>" <?= in_array($sports_key, $sports_check) ? "checked='checked'" : '' ?>  />
                
            </li>
        <?php endforeach; ?>
    </ul>
    </p>
    <p><input type="submit" value="확인"/></p>
</form>