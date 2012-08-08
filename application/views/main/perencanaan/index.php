<h2>Daftar Diklat Tahun <?php echo date('Y'); ?></h2>
<div>
    <h3>DIKLAT PRAJABATAN</h3>
    <div class="accordion">
        <?php
        $kiri = '<div class="accordion-group"><div class="accordion-heading"><h4>';
        $kanan = '</h4></div></div>';
        $kelas = 'accordion-toggle';
        $this->lib_perencanaan->print_child($program, 1, $kiri, $kanan, $kelas)
        ?>
    </div>
</div>
<div>
    <h3>DIKLAT DALAM JABATAN</h3>
    <div class="accordion" id="accordion1">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1a">
                    <h4>Diklat Kepemimpinan</h4>
                </a>
            </div>
            <div id="collapse1a" class="accordion-body collapse">
                <div class="accordion-inner">
                    <ol>
                        <?php $this->lib_perencanaan->print_child($program, 4, '<li>', '</li>', '') ?>
                    </ol>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1b">
                    <h4>Diklat Fungsional</h4>
                </a>
            </div>
            <div id="collapse1b" class="accordion-body collapse">

                <div class="accordion-inner">
                    <div class="accordion" id="accordion2b">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2b" href="#collapseOneb">
                                    Diklat Fungsional Keahlian
                                </a>
                            </div>
                            <div id="collapseOneb" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <ol>
                                        <?php $this->lib_perencanaan->print_child($program, 8, '<li>', '</li>', '') ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2b" href="#collapseTwob">
                                    Diklat Tehnis Fungsional
                                </a>
                            </div>
                            <div id="collapseTwob" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <ol>
                                        <?php $this->lib_perencanaan->print_child($program, 9, '<li>', '</li>', '') ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h3>DIKLAT TEKNIS</h3>
        <div class="accordion" id="accordion3">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse3a">
                        <h4>Diklat Teknis Umum</h4>
                    </a>
                </div>
                <div id="collapse3a" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ol>
                            <?php $this->lib_perencanaan->print_child($program, 6, '<li>', '</li>', '') ?>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse3b">
                        <h4>Diklat Teknis Manajemen</h4>
                    </a>
                </div>
                <div id="collapse3b" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ol>
                            <?php $this->lib_perencanaan->print_child($program, 7, '<li>', '</li>', '') ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="perencanaan/dashboard/buat_diklat" class="btn btn-primary">Buat Diklat</a>
