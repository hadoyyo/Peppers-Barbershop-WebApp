<form method="POST" class="mt-4">

            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <label for="service" class="form-label">Wybierz usługę</label>
                    <select class="form-select select-with-arrow mb-3" id="service" name="service" style="margin-top: 5px;" required>
                        <option value="Strzyżenie włosów">Strzyżenie włosów - 100zł</option>
                        <option value="Strzyżenie zarostu">Strzyżenie zarostu - 70zł</option>
                        <option value="Strzyżenie włosów i zarostu">Strzyżenie włosów i zarostu - 130zł</option>
                        <option value="Repigmentacja zarostu">Repigmentacja zarostu - 35zł</option>
                        <option value="Repigmentacja zarostu i włosów">Repigmentacja zarostu i włosów - 60zł</option>
                        <option value="Farbowanie">Farbowanie - 110zł</option>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="barber" class="form-label">Wybierz barbera</label>
                <div class="d-flex align-items-center">
                    <select class="form-select select-with-arrow w-75" id="barber" name="barber" required>
                        <?php
                        //pobierz barberów z bazy danych (status = 2)
                        $barberQuery = "SELECT id, fullName FROM users WHERE status = 2";
                        $barberResult = $mysqli->query($barberQuery);

                        if ($barberResult->num_rows > 0) {
                            while ($barber = $barberResult->fetch_assoc()) {
                                echo "<option value='{$barber['id']}'>{$barber['fullName']}</option>";
                            }
                        } else {
                            echo "<option value=''>Brak dostępnych barberów</option>";
                        }
                        ?>
                    </select>
                    <img id="barber-image" src="img/barber_mini1.jpg" alt="Tomek" class="img-fluid ms-3" style="height: 55px; width:55px; border-radius: 50%;"/>
                </div>
            </div>

            </div>

            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <label for="date" class="form-label">Wybierz datę</label>
                    <input type="date" class="form-control mb-3" id="date" name="date" required>
                </div>
                <div class="col-md-6">
                    <label for="time" class="form-label">Wybierz godzinę</label>
                    <select class="form-select select-with-arrow" id="time" name="time" required>
                        <?php
                        foreach ($availableHours as $hour) {
                            echo "<option value='$hour'>$hour</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <button type="submit" class="btn btn-xl custom-btn w-50 color-red mb-2">Umów</button>
            </div>
</form>