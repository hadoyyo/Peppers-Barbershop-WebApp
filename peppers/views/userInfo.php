<?php
                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    echo "<p class='fs-5 color-red'><b class>Imię i nazwisko:</b> " . htmlspecialchars($user['fullName']) . "</p>";
                    echo "<p class='fs-5 color-red'><b>Nazwa użytkownika:</b> " . htmlspecialchars($user['userName']) . "</p>";
                    echo "<p class='fs-5 color-red'><b>Email:</b> " . htmlspecialchars($user['email']) . "</p><br>";

                    echo "<div class='d-flex gap-2'>";
                    echo "<a href='userEdit.php' class='btn btn-xl custom-btn' style='width:17rem'><i class='bi bi-pencil-square'></i> Edytuj dane</a>";
                    echo "<a href='#' id='deleteAccountBtn' class='btn btn-xl custom-btn' style='width:17rem;'><i class='bi bi-trash'></i> Usuń konto</a>";
                    echo "</div>";

                } else {
                    echo "<p class='fs-5 color-red'>Nie znaleziono użytkownika w bazie danych.</p>";
                }
                ?>