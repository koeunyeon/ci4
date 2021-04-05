<table>
    <tr>
        <td>parent_name</td>
        <td>child_name</td>
        <td>parent_id</td>
        <td>child_id</td>
    </tr>

<?php foreach ($all_result as $row) : ?>
    <tr>
        <td><?= $row['parent_name'] ?></td>
        <td><?= $row['child_name'] ?></td>
        <td><?= $row['sample_parent_id'] ?></td>
        <td><?= $row['sample_child_id'] ?></td>
    </tr>
<?php endforeach; ?>
</table>