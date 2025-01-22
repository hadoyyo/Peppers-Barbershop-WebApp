<?php
    //filtrowanie
    $conditions = [];
    if (!empty($_GET['filter_id'])) {
        $conditions[] = "id = '" . $mysqli->real_escape_string($_GET['filter_id']) . "'";
    }
    if (!empty($_GET['filter_username'])) {
        $conditions[] = "userName LIKE '%" . $mysqli->real_escape_string($_GET['filter_username']) . "%'";
    }
    if (!empty($_GET['filter_fullname'])) {
        $conditions[] = "fullName LIKE '%" . $mysqli->real_escape_string($_GET['filter_fullname']) . "%'";
    }
    if (!empty($_GET['filter_status'])) {
        $conditions[] = "status = '" . $mysqli->real_escape_string($_GET['filter_status']) . "'";
    }
    if (!empty($_GET['filter_email'])) {
        $conditions[] = "email LIKE '%" . $mysqli->real_escape_string($_GET['filter_email']) . "%'";
    }

    $whereClause = '';
    if (count($conditions) > 0) {
        $whereClause = "WHERE " . implode(" AND ", $conditions);
    }

    //sortowanie
    $validColumns = ['id', 'userName', 'fullName', 'email', 'status', 'date'];
    $sortColumn = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $validColumns) ? $_GET['sort_column'] : 'id';
    $sortOrder = isset($_GET['sort_order']) && in_array($_GET['sort_order'], ['ASC', 'DESC']) ? $_GET['sort_order'] : 'ASC';

    //sortowanie
    $usersQuery = "SELECT id, userName, fullName, email, status, date FROM users $whereClause ORDER BY $sortColumn $sortOrder";
    $result = $mysqli->query($usersQuery);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-dark table-striped text-center mt-4'>";
        echo "<thead>
        <tr>
            <th><a href='?sort_column=id&sort_order=" . ($sortColumn == 'id' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>ID " . ($sortColumn == 'id' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=userName&sort_order=" . ($sortColumn == 'userName' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Nazwa użyt. " . ($sortColumn == 'userName' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=fullName&sort_order=" . ($sortColumn == 'fullName' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Imię i nazw. " . ($sortColumn == 'fullName' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=email&sort_order=" . ($sortColumn == 'email' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>E-mail " . ($sortColumn == 'email' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=status&sort_order=" . ($sortColumn == 'status' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Status " . ($sortColumn == 'status' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=date&sort_order=" . ($sortColumn == 'date' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Data dołącz. " . ($sortColumn == 'date' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th class='color-red'>Akcje</th>
            </tr>
            </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == 1) {
                $status = "Klient";
            } elseif ($row['status'] == 2) {
                $status = "Barber";
            } elseif ($row['status'] == 3) {
                $status = "Admin";
            } else {
                $status = "Nieznany";
            }

            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['userName']}</td>
                    <td>{$row['fullName']}</td>
                    <td>{$row['email']}</td>
                    <td>$status</td>
                    <td>{$row['date']}</td>
                    <td>"; ?>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="userId" value="<?php echo $row['id']; ?>">
                        <button type="button" class="btn custom-btn-table btn-sm color-red mt-2"
                                onclick="editUser(<?php echo $row['id']; ?>)">
                            <i class="bi bi-pencil"></i> Edytuj
                        </button>
                    </form>
                        <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="userId" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="deleteUser" class="btn custom-btn-table btn-sm color-red mt-2" 
                            onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                            <i class="bi bi-trash"></i> Usuń
                        </button>
                    </form>
                    </td>
                </tr> <?php
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='text-center color-red fs-5 mt-5'><i class='bi bi-x-lg'></i> Brak użytkowników spełniających kryteria.</p>";
    }
    ?>
</div>