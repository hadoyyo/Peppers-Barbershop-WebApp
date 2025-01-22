<!-- Modal edycji użytkownika -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title color-red" id="editUserModalLabel">Edytuj użytkownika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm" method="POST" action="">
          <input type="hidden" name="userId" id="userId">

          <div class="mb-3">
            <label for="userName" class="form-label">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="userName" name="userName" required>
          </div>

          <div class="mb-3">
            <label for="fullName" class="form-label">Imię i nazwisko</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control select-with-arrow" id="status" name="status" required>
              <option value="1">Klient</option>
              <option value="2">Barber</option>
              <option value="3">Admin</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="passwd" class="form-label">Hasło (opcjonalne)</label>
            <input type="password" class="form-control" id="passwd" name="passwd">
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn custom-btn btn-lg color-red">Zapisz zmiany</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal dodania nowego użytkownika -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title color-red" id="addUserModalLabel">Dodaj nowego użytkownika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUserForm" method="POST" action="">
          <div class="mb-3">
            <label for="addUserName" class="form-label">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="addUserName" name="userName" required>
          </div>

          <div class="mb-3">
            <label for="addFullName" class="form-label">Imię i nazwisko</label>
            <input type="text" class="form-control" id="addFullName" name="fullName" required>
          </div>

          <div class="mb-3">
            <label for="addEmail" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="addEmail" name="email" required>
          </div>

          <div class="mb-3">
            <label for="addStatus" class="form-label">Status</label>
            <select class="form-control select-with-arrow" id="addStatus" name="status" required>
              <option value="1">Klient</option>
              <option value="2">Barber</option>
              <option value="3">Admin</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="addPasswd" class="form-label">Hasło</label>
            <input type="password" class="form-control" id="addPasswd" name="passwd" required>
        </div>


          <div class="d-flex justify-content-center">
            <button type="submit" class="btn custom-btn btn-lg color-red">Dodaj użytkownika</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal edycji wizyty -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title color-red" id="editBookingModalLabel">Edytuj wizytę</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editBookingForm" method="POST" action="">
          <input type="hidden" name="bookingId" id="bookingId">

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="clientId" class="form-label">ID Klienta</label>
              <input type="number" class="form-control" id="clientId" name="clientId" min="1" required>
            </div>
            <div class="col-md-6">
              <label for="barber" class="form-label">Wybierz barbera</label>
              <div class="d-flex align-items-center">
                <select class="form-select select-with-arrow w-75" id="barber" name="barber" required>
                  <?php
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

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="date" class="form-label">Wybierz datę</label>
              <input type="date" class="form-control" id="date" name="date" required>
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

          <div class="mb-3">
            <label for="service" class="form-label">Wybierz usługę</label>
            <select class="form-select select-with-arrow" id="service" name="service" required>
              <option value="Strzyżenie włosów">Strzyżenie włosów - 100zł</option>
              <option value="Strzyżenie zarostu">Strzyżenie zarostu - 70zł</option>
              <option value="Strzyżenie włosów i zarostu">Strzyżenie włosów i zarostu - 130zł</option>
              <option value="Repigmentacja zarostu">Repigmentacja zarostu - 35zł</option>
              <option value="Repigmentacja zarostu i włosów">Repigmentacja zarostu i włosów - 60zł</option>
              <option value="Farbowanie">Farbowanie - 110zł</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control select-with-arrow" id="status" name="status" required>
              <option value="0">Oczekuje na potwierdzenie</option>
              <option value="1">Potwierdzona</option>
              <option value="2">Odrzucona przez barbera</option>
              <option value="3">Anulowana</option>
              <option value="4">Zakończona</option>
              <option value="5">W trakcie</option>
            </select>
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn custom-btn btn-lg color-red">Zapisz zmiany</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>