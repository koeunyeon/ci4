<table>
    <tr>
        <th>이름</th>
        <th>나이</th>
        <th>성별</th>
    </tr>
    <?php foreach ($table_data as $row) : ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['age'] ?></td>
        <td><?= $row['gender'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>