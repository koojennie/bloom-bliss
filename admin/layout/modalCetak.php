<!-- modal Order -->

<div class="modal fade" id="cetak_perbulan_order" tabindex="-1" aria-labelledby="cetak_perbulan_order"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form action="report/orderReportPerMonth.php" target="_blank" method="POST">
          <div class="form-group">
            <label for="">Choose Month</label>
            <select name="month" class="form-select">
              <option value="12"> December </option>
              <option value="11"> November </option>
              <option value="10"> October </option>
              <option value="09"> September </option>
              <option value="08"> August </option>
              <option value="07"> July </option>
              <option value="06"> June </option>
              <option value="05"> May </option>
              <option value="04"> April </option>
              <option value="03"> March </option>
              <option value="02"> February </option>
              <option value="01"> January </option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Choose Year</label>
            <select name="year" class="form-select">
              <?php
              for ($i = substr(date("d-m-Y"), 6, 4); $i > substr(date("d-m-Y"), 6, 4) - 5; $i--) { ?>
                <option value="<?= $i ?>"> <?= $i ?> </option>
              <?php }
              ?>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-info btn-sm mt-3">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal Laporan -->
<div class="modal fade" id="cetak_perbulan_laporan" tabindex="-1" aria-labelledby="cetak_perbulan_laporan"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form action="report/laporanReportPerMonth.php" target="_blank" method="POST">
          <div class="form-group">
            <label for="">Choose Month</label>
            <select name="month" class="form-select">
              <option value="12"> December </option>
              <option value="11"> November </option>
              <option value="10"> October </option>
              <option value="09"> September </option>
              <option value="08"> August </option>
              <option value="07"> July </option>
              <option value="06"> June </option>
              <option value="05"> May </option>
              <option value="04"> April </option>
              <option value="03"> March </option>
              <option value="02"> February </option>
              <option value="01"> January </option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Choose Year</label>
            <select name="year" class="form-select">
              <?php
              for ($i = substr(date("d-m-Y"), 6, 4); $i > substr(date("d-m-Y"), 6, 4) - 5; $i--) { ?>
                <option value="<?= $i ?>"> <?= $i ?> </option>
              <?php }
              ?>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-info btn-sm mt-3">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>