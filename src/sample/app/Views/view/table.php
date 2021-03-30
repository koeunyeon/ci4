<table> <!-- (1) -->
    <tr>  <!-- (2) -->
        <th>이름</th>  <!-- (3) -->
        <th>나이</th>
        <th>성별</th>
    </tr>
    <?php foreach ($table_data as $row) : ?>  <!-- (4) -->
    <tr> <!-- (5) -->
        <td><?= $row['name'] ?></td>  <!-- (6) -->
        <td><?= $row['age'] ?></td>
        <td><?= $row['gender'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>