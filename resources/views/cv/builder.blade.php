@extends('layouts.app')

@section('title', 'CV Builder - RESUVO')

@section('styles')
<style>
    :root {
        --step-color: #e2e8f0;
        --step-active-color: var(--primary-color);
        --step-text-color: #64748b;
    }
    .builder-container {
        padding-top: 100px;
        padding-bottom: 80px;
        background-color: #f8fafc;
        min-height: 100vh;
    }
    
    /* Stepper UI */
    .stepper {
        display: flex;
        justify-content: space-between;
        margin-bottom: 40px;
        position: relative;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    .stepper::before {
        content: "";
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--step-color);
        z-index: 1;
    }
    .step-item {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100px;
    }
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid var(--step-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--step-text-color);
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    .step-item.active .step-circle {
        border-color: var(--step-active-color);
        background: var(--step-active-color);
        color: #fff;
        box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.1);
    }
    .step-item.completed .step-circle {
        background: #22c55e;
        border-color: #22c55e;
        color: #fff;
    }
    .step-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--step-text-color);
        text-align: center;
    }
    .step-item.active .step-label {
        color: var(--step-active-color);
    }

    /* Grid Layout */
    .builder-grid {
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 30px;
        align-items: start;
    }
    
    @media (max-width: 1200px) {
        .builder-grid {
            grid-template-columns: 360px 1fr;
        }
    }
    @media (max-width: 900px) {
        .builder-grid {
            grid-template-columns: 1fr;
        }
        .preview-side {
            position: static;
            order: -1; /* Tetap di atas pada layar kecil */
        }
        .preview-content {
            min-height: auto;
        }
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 40px;
        margin-bottom: 20px;
    }

    .form-step {
        display: none;
    }
    .form-step.active {
        display: block;
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.05);
    }

    .dynamic-row {
        padding: 20px;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        margin-bottom: 20px;
        position: relative;
        background: #f8fafc;
    }
    .remove-row {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #ef4444;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Preview Side */
    .preview-side {
        position: sticky;
        top: 100px;
    }
    .preview-content {
        background: #fff;
        padding: 30px;
        min-height: 550px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        font-family: 'Inter', sans-serif;
        font-size: 11px;
        line-height: 1.4;
    }
    .preview-header {
        text-align: center;
        margin-bottom: 15px;
    }
    .preview-header h1 {
        font-size: 1.5rem;
        text-transform: uppercase;
        margin-bottom: 5px;
        letter-spacing: 1px;
    }
    .preview-section {
        margin-bottom: 15px;
    }
    .preview-section-title {
        font-weight: 800;
        text-transform: uppercase;
        border-bottom: 1px solid #000;
        margin-bottom: 8px;
        padding-bottom: 2px;
    }
</style>
@endsection

@section('content')
<div class="builder-container">
    <div class="container">
        <!-- Stepper -->
        <div class="stepper">
            <div class="step-item active" data-step="1">
                <div class="step-circle">1</div>
                <div class="step-label">Pribadi</div>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-circle">2</div>
                <div class="step-label">Profesional</div>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-circle">3</div>
                <div class="step-label">Pendidikan</div>
            </div>
            <div class="step-item" data-step="4">
                <div class="step-circle">4</div>
                <div class="step-label">Organisasi</div>
            </div>
            <div class="step-item" data-step="5">
                <div class="step-circle">5</div>
                <div class="step-label">Lainnya</div>
            </div>
            <div class="step-item" data-step="6">
                <div class="step-circle">6</div>
                <div class="step-label">Tinjau</div>
            </div>
        </div>

        <form id="cv-form" action="{{ route('cv.store') }}" method="POST">
            @csrf
            <div class="builder-grid">
                <!-- Form Side — kolom KANAN (order:2) -->
                <div style="order:2;">

                    <!-- Step 1: Informasi Pribadi -->
                    <div class="form-step active" id="step-1">
                        <div class="card">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                                <div>
                                    <h2 style="font-size: 1.5rem; color: #0f172a;">Informasi Pribadi</h2>
                                    <p style="color: #64748b; font-size: 0.9rem;">Bantu recruiter mengenal kamu</p>
                                </div>
                                <div style="background: #fef3c7; color: #92400e; padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">
                                    <i class="fas fa-lightbulb"></i> TIPS
                                </div>
                            </div>

                            {{-- Foto Profil --}}
                            <div class="form-group" style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
                                <div id="photo-preview-wrapper" style="width: 90px; height: 90px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; border: 2px dashed #94a3b8; cursor: pointer;" onclick="document.getElementById('photo-input').click()">
                                    <img id="photo-preview-img" src="" style="width:100%;height:100%;object-fit:cover;display:none;" alt="Foto Profil">
                                    <i id="photo-placeholder-icon" class="fas fa-user-circle" style="font-size: 2.5rem; color: #94a3b8;"></i>
                                </div>
                                <div>
                                    <p style="font-weight: 600; font-size: 0.9rem; color: #1e293b; margin-bottom: 4px;">Foto Profil</p>
                                    <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 10px;">Format: JPG/PNG. Tampil di pojok kiri CV.</p>
                                    <input type="file" id="photo-input" name="photo" accept="image/*" style="display:none" onchange="handlePhotoUpload(event)">
                                    <button type="button" class="btn btn-outline" style="font-size: 0.8rem; padding: 6px 14px;" onclick="document.getElementById('photo-input').click()">
                                        <i class="fas fa-upload"></i> Upload Foto
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="content[personal][photo]" id="in-photo">

                            <div class="form-group">
                                <label>Nama Lengkap <span style="color:red">*</span></label>
                                <input type="text" name="content[personal][full_name]" id="in-name" class="form-control" placeholder="Contoh: Aditya Pratama Putra" required oninput="updatePreview()">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div class="form-group">
                                    <label>Nomor Handphone</label>
                                    <input type="text" name="content[personal][phone]" id="in-phone" class="form-control" placeholder="+62 812 3456 7890" oninput="updatePreview()">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Email</label>
                                    <input type="email" name="content[personal][email]" id="in-email" class="form-control" placeholder="nama.anda@email.com" oninput="updatePreview()">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div class="form-group">
                                    <label>URL Profil LinkedIn</label>
                                    <input type="text" name="content[personal][linkedin]" id="in-linkedin" class="form-control" placeholder="linkedin.com/in/username" oninput="updatePreview()">
                                </div>
                                <div class="form-group">
                                    <label>GitHub / Portfolio Website</label>
                                    <input type="text" name="content[personal][website]" id="in-website" class="form-control" placeholder="github.com/username" oninput="updatePreview()">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Kota, Negara</label>
                                <input type="text" name="content[personal][address]" id="in-address" class="form-control" placeholder="Bekasi, Indonesia" oninput="updatePreview()">
                            </div>

                            <div class="form-group">
                                <label>Ringkasan Profesional</label>
                                <textarea name="content[personal][summary]" id="in-summary" class="form-control" rows="5" placeholder="Tuliskan ringkasan profesional Anda di sini..." oninput="updatePreview()"></textarea>
                                <p style="font-size: 0.7rem; color: #94a3b8; margin-top: 5px;">Direkomendasikan: 100 hingga 200 karakter</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Profesional (Pengalaman Kerja) -->
                    <div class="form-step" id="step-2">
                        <div class="card">
                            <h2 style="margin-bottom: 10px;">Pengalaman Profesional</h2>
                            <p style="color: #64748b; margin-bottom: 30px;">Daftar pekerjaan atau magang yang pernah Anda jalani.</p>
                            
                            <div id="experience-container">
                                <!-- Dynamic rows go here -->
                            </div>
                            
                            <button type="button" class="btn btn-outline" onclick="addRow('experience')" style="width: 100%; border-style: dashed;">
                                <i class="fas fa-plus"></i> Tambah Pengalaman
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Pendidikan -->
                    <div class="form-step" id="step-3">
                        <div class="card">
                            <h2 style="margin-bottom: 5px;">Pendidikan</h2>
                            <p style="color: #64748b; margin-bottom: 25px; font-size: 0.9rem;">Mulai dari pendidikan terakhir kamu ya</p>
                            <div id="education-container"></div>
                            <button type="button" class="btn btn-outline" onclick="addRow('education')" style="width: 100%; border-style: dashed;">
                                <i class="fas fa-plus"></i> Tambah Pendidikan
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Organisasi -->
                    <div class="form-step" id="step-4">
                        <div class="card">
                            <h2 style="margin-bottom: 5px;">Organizational Experience</h2>
                            <p style="color: #64748b; margin-bottom: 25px; font-size: 0.9rem;">Mulai dengan pengalaman terakhir kamu</p>
                            <div id="organization-container"></div>
                            <button type="button" class="btn btn-outline" onclick="addRow('organization')" style="width: 100%; border-style: dashed;">
                                <i class="fas fa-plus"></i> Tambah Organisasi
                            </button>
                        </div>
                    </div>

                    <!-- Step 5: Lainnya -->
                    <div class="form-step" id="step-5">
                        <div class="card">
                            <h2 style="margin-bottom: 5px;">Technical Skills, Projects and Achievements</h2>
                            <p style="color: #64748b; margin-bottom: 25px; font-size: 0.9rem;">Tambahkan keterampilan dan pencapaian yang relevan</p>
                            <div id="skills-container"></div>
                            <button type="button" class="btn btn-outline" onclick="addRow('skill')" style="width: 100%; border-style: dashed;">
                                <i class="fas fa-plus"></i> Tambah Keahlian / Prestasi
                            </button>
                            <div class="form-group" style="margin-top: 25px;">
                                <label>Bahasa</label>
                                <input type="text" name="content[other][languages]" class="form-control" placeholder="Indonesia (Native), Inggris (Professional)">
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Tinjau -->
                    <div class="form-step" id="step-6">
                        <div class="card" style="text-align: center;">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #22c55e; margin-bottom: 20px;"></i>
                            <h2 style="margin-bottom: 10px;">Hampir Selesai!</h2>
                            <p style="color: #64748b; margin-bottom: 30px;">Tinjau CV Anda di sisi kanan. Jika sudah sesuai, silakan klik tombol Simpan & Download.</p>
                            
                            <div style="background: #f8fafc; padding: 20px; border-radius: 12px; text-align: left; margin-bottom: 30px;">
                                <h4 style="margin-bottom: 10px;">Detail Pesanan:</h4>
                                <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                                    <span>Template CV ATS Premium</span>
                                    <span style="font-weight: 700;">Rp 15.000</span>
                                </div>
                                <hr style="margin: 15px 0; border: none; border-top: 1px solid #e2e8f0;">
                                <div style="display: flex; justify-content: space-between; font-weight: 800; font-size: 1rem;">
                                    <span>Total</span>
                                    <span>Rp 15.000</span>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                                Simpan & Bayar untuk Download
                            </button>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                        <button type="button" id="prev-btn" class="btn btn-outline" style="visibility: hidden;" onclick="changeStep(-1)">Kembali</button>
                        <button type="button" id="next-btn" class="btn btn-primary" onclick="changeStep(1)">Lanjutkan</button>
                    </div>
                </div><!-- /form-side -->

                <!-- Preview Side — kolom KIRI -->
                <div class="preview-side" style="order:1;">
                    <div style="background: #1e293b; color: #fff; padding: 12px 20px; border-radius: 12px 12px 0 0; font-size: 0.8rem; font-weight: 600; display: flex; justify-content: space-between; align-items: center;">
                        <span>PRATINJAU ATS (TIDAK BERWARNA)</span>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="preview-content" id="cv-preview">
                        <div class="preview-header" style="display:flex;align-items:flex-start;gap:10px;">
                            <img id="p-photo-preview" src="" alt="" style="width:65px;height:65px;object-fit:cover;border-radius:3px;display:none;flex-shrink:0;">
                            <div style="flex:1;">
                                <h1 id="p-name" style="text-align:left;font-size:14pt;">NAMA LENGKAP ANDA</h1>
                                <div class="cv-contact" style="display:flex;justify-content:flex-start;gap:4px;font-size:7.5pt;flex-wrap:wrap;">
                                    <span id="p-address">Kota, Indonesia</span>
                                    <span id="p-phone-row" style="display:none;"> | <span id="p-phone"></span></span>
                                    <span id="p-email-row" style="display:none;"> | <span id="p-email"></span></span>
                                    <span id="p-linkedin-row" style="display:none;"> | <span id="p-linkedin"></span></span>
                                    <span id="p-website-row" style="display:none;"> | <span id="p-website"></span></span>
                                </div>
                            </div>
                        </div>

                        <div class="preview-section" id="p-summary-section" style="display:none; margin-top: 10px;">
                            <p id="p-summary" style="text-align: justify; font-size: 9pt; line-height: 1.4;"></p>
                        </div>

                        <div id="p-experience-section" class="preview-section" style="display: none;">
                            <div class="preview-section-title">EXPERIENCE</div>
                            <div id="p-experience-list"></div>
                        </div>

                        <div id="p-education-section" class="preview-section" style="display: none;">
                            <div class="preview-section-title">EDUCATION</div>
                            <div id="p-education-list"></div>
                        </div>

                        <div id="p-organization-section" class="preview-section" style="display: none;">
                            <div class="preview-section-title">ORGANIZATION EXPERIENCE</div>
                            <div id="p-organization-list"></div>
                        </div>

                        <div id="p-skills-section" class="preview-section" style="display: none;">
                            <div class="preview-section-title">SKILLS & ACHIEVEMENTS</div>
                            <div id="p-skills-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 6;

    function changeStep(n) {
        if (n === 1 && !validateStep()) return;
        
        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.querySelector(`.step-item[data-step="${currentStep}"]`).classList.remove('active');
        if (n === 1) document.querySelector(`.step-item[data-step="${currentStep}"]`).classList.add('completed');
        
        currentStep += n;
        
        document.getElementById(`step-${currentStep}`).classList.add('active');
        document.querySelector(`.step-item[data-step="${currentStep}"]`).classList.add('active');
        
        // Update buttons
        document.getElementById('prev-btn').style.visibility = currentStep === 1 ? 'hidden' : 'visible';
        document.getElementById('next-btn').style.display = currentStep === totalSteps ? 'none' : 'block';
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep() {
        // Simple validation
        const currentStepEl = document.getElementById(`step-${currentStep}`);
        const inputs = currentStepEl.querySelectorAll('input[required]');
        let valid = true;
        inputs.forEach(input => {
            if (!input.value) {
                input.style.borderColor = '#ef4444';
                valid = false;
            } else {
                input.style.borderColor = '#e2e8f0';
            }
        });
        return valid;
    }

    // Dynamic Rows Logic
    const counters = { experience: 0, education: 0, organization: 0, skill: 0 };

    const MONTHS_ID = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const YEARS = Array.from({length: 30}, (_,i) => new Date().getFullYear() + 5 - i);

    function monthSelect(name, placeholder='Bulan') {
        return `<select name="${name}" class="form-control" onchange="updatePreview()"><option value="">${placeholder}</option>${MONTHS_ID.map((m,i)=>`<option value="${String(i+1).padStart(2,'0')}">${m}</option>`).join('')}</select>`;
    }
    function yearSelect(name, placeholder='Tahun') {
        return `<select name="${name}" class="form-control" onchange="updatePreview()"><option value="">${placeholder}</option>${YEARS.map(y=>`<option value="${y}">${y}</option>`).join('')}</select>`;
    }
    function addRow(type) {
        counters[type]++;
        const n = counters[type];
        const container = document.getElementById(`${type === 'skill' ? 'skills' : type}-container`);
        const id = `${type}-${n}`;
        let html = '';

        if (type === 'experience') {
            html = `<div class="dynamic-row" id="${id}">
                <span class="remove-row" onclick="removeRow('${id}')"><i class="fas fa-trash-alt"></i> Hapus</span>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group"><label>Nama Perusahaan</label>
                    <input type="text" name="content[experience][${n}][company]" class="form-control" placeholder="Contoh: PT Teknologi Indonesia" oninput="updatePreview()"></div>
                    <div class="form-group"><label>Jabatan/Role</label>
                    <input type="text" name="content[experience][${n}][role]" class="form-control" placeholder="Contoh: Frontend Developer" oninput="updatePreview()"></div>
                </div>
                <div class="form-group"><label>Lokasi (Kota, Negara)</label>
                <input type="text" name="content[experience][${n}][location]" class="form-control" placeholder="Contoh: Jakarta, Indonesia" oninput="updatePreview()"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;">
                    <div class="form-group"><label>Mulai (Bln)</label>${monthSelect(`content[experience][${n}][start_month]`)}</div>
                    <div class="form-group"><label>Mulai (Thn)</label>${yearSelect(`content[experience][${n}][start_year]`)}</div>
                    <div class="form-group"><label>Selesai (Bln)</label>${monthSelect(`content[experience][${n}][end_month]`,'Sekarang')}</div>
                    <div class="form-group"><label>Selesai (Thn)</label>${yearSelect(`content[experience][${n}][end_year]`,'Sekarang')}</div>
                </div>
                <div class="form-group"><label>Deskripsi Pekerjaan</label>
                <textarea name="content[experience][${n}][desc]" class="form-control" rows="4" placeholder="• Mengembangkan fitur utama menggunakan React..." oninput="updatePreview()"></textarea>
                <p style="font-size:0.75rem;color:#94a3b8;margin-top:4px;">Gunakan baris baru untuk membuat bullet point otomatis.</p></div>
            </div>`;

        } else if (type === 'education') {
            html = `<div class="dynamic-row" id="${id}">
                <span class="remove-row" onclick="removeRow('${id}')"><i class="fas fa-trash-alt"></i> Hapus</span>
                <div class="form-group"><label>Nama Sekolah/Universitas</label>
                <input type="text" name="content[education][${n}][school]" class="form-control" placeholder="Contoh: Universitas Gadjah Mada" oninput="updatePreview()"></div>
                <div class="form-group"><label>Lokasi Sekolah/Universitas</label>
                <input type="text" name="content[education][${n}][location]" class="form-control" placeholder="Contoh: Yogyakarta, Indonesia" oninput="updatePreview()"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;">
                    <div class="form-group"><label>Mulai (Bln)</label>${monthSelect(`content[education][${n}][start_month]`)}</div>
                    <div class="form-group"><label>Mulai (Thn)</label>${yearSelect(`content[education][${n}][start_year]`)}</div>
                    <div class="form-group"><label>Lulus (Bln)</label>${monthSelect(`content[education][${n}][end_month]`)}</div>
                    <div class="form-group"><label>Lulus (Thn)</label>${yearSelect(`content[education][${n}][end_year]`)}</div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group"><label>Jenjang Pendidikan</label>
                    <select name="content[education][${n}][degree_level]" class="form-control" onchange="updatePreview()">
                        <option value="">Pilih Jenjang</option>
                        <option>SMA/SMK</option><option>D3</option><option>D4</option>
                        <option>Bachelor (S1)</option><option>Master (S2)</option><option>Doctor (S3)</option>
                    </select></div>
                    <div class="form-group"><label>Program Studi / Jurusan</label>
                    <input type="text" name="content[education][${n}][major]" class="form-control" placeholder="Contoh: Ilmu Komputer" oninput="updatePreview()"></div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group"><label>IPK (Opsional)</label>
                    <input type="text" name="content[education][${n}][gpa]" class="form-control" placeholder="Contoh: 3.90" oninput="updatePreview()"></div>
                    <div class="form-group"><label>IPK Maksimal</label>
                    <input type="text" name="content[education][${n}][gpa_max]" class="form-control" placeholder="Contoh: 4.00" oninput="updatePreview()"></div>
                </div>
                <div class="form-group"><label>Aktivitas dan Pencapaian (opsional)</label>
                <textarea name="content[education][${n}][activities]" class="form-control" rows="3" placeholder="• Ketua Himpunan Mahasiswa..." oninput="updatePreview()"></textarea></div>
            </div>`;

        } else if (type === 'organization') {
            html = `<div class="dynamic-row" id="${id}">
                <span class="remove-row" onclick="removeRow('${id}')"><i class="fas fa-trash-alt"></i> Hapus</span>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div class="form-group"><label>Organisasi/Nama Event</label>
                    <input type="text" name="content[organization][${n}][name]" class="form-control" placeholder="Contoh: AIESEC Indonesia" oninput="updatePreview()"></div>
                    <div class="form-group"><label>Posisi/Gelar Jabatan</label>
                    <input type="text" name="content[organization][${n}][role]" class="form-control" placeholder="Contoh: Volunteer" oninput="updatePreview()"></div>
                </div>
                <div class="form-group"><label>Aktivitas/Event/Lokasi Organisasi</label>
                <input type="text" name="content[organization][${n}][location]" class="form-control" placeholder="Contoh: Jakarta, Indonesia" oninput="updatePreview()"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;">
                    <div class="form-group"><label>Mulai (Bln)</label>${monthSelect(`content[organization][${n}][start_month]`)}</div>
                    <div class="form-group"><label>Mulai (Thn)</label>${yearSelect(`content[organization][${n}][start_year]`)}</div>
                    <div class="form-group"><label>Selesai (Bln)</label>${monthSelect(`content[organization][${n}][end_month]`,'Pilih')}</div>
                    <div class="form-group"><label>Selesai (Thn)</label>${yearSelect(`content[organization][${n}][end_year]`,'Pilih')}</div>
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" name="content[organization][${n}][current]" value="1" id="org-cur-${n}" onchange="toggleCurrentOrg(this,'${n}')">
                    <label for="org-cur-${n}" style="margin:0;font-weight:400;cursor:pointer;">Saat ini saya aktif di sini</label>
                </div>
                <div class="form-group"><label>Deskripsi Pekerjaan</label>
                <textarea name="content[organization][${n}][desc]" class="form-control" rows="4" placeholder="• Mengkoordinasi tim untuk event..." oninput="updatePreview()"></textarea></div>
            </div>`;

        } else if (type === 'skill') {
            html = `<div class="dynamic-row" id="${id}">
                <span class="remove-row" onclick="removeRow('${id}')"><i class="fas fa-trash-alt"></i> Hapus</span>
                <div class="form-group"><label>Kategori</label>
                <select name="content[skills][${n}][category]" class="form-control" onchange="updatePreview()">
                    <option value="Hard Skills">Hard Skills</option>
                    <option value="Soft Skills">Soft Skills</option>
                    <option value="Prestasi">Prestasi</option>
                    <option value="Proyek">Proyek</option>
                    <option value="Sertifikasi">Sertifikasi</option>
                </select></div>
                <div class="form-group"><label>Penjelasan / Detail</label>
                <input type="text" name="content[skills][${n}][detail]" class="form-control" placeholder="Contoh: PHP, Laravel, JavaScript, MySQL..." oninput="updatePreview()"></div>
            </div>`;
        }
        
        container.insertAdjacentHTML('beforeend', html);
        updatePreview();
    }

    function toggleCurrentOrg(checkbox, n) {
        const row = checkbox.closest('.dynamic-row');
        ['end_month','end_year'].forEach(f => {
            const el = row.querySelector(`[name="content[organization][${n}][${f}]"]`);
            if (el) el.disabled = checkbox.checked;
        });
        updatePreview();
    }

    function removeRow(id) {
        document.getElementById(id).remove();
        updatePreview();
    }

    function handlePhotoUpload(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('photo-preview-img').src = e.target.result;
            document.getElementById('photo-preview-img').style.display = 'block';
            document.getElementById('photo-placeholder-icon').style.display = 'none';
            document.getElementById('p-photo-preview').src = e.target.result;
            document.getElementById('p-photo-preview').style.display = 'block';
            document.getElementById('in-photo').value = e.target.result;
            updatePreview();
        };
        reader.readAsDataURL(file);
    }

    function renderBullets(text) {
        if (!text) return '';
        const lines = text.split('\n').filter(line => line.trim() !== '');
        if (lines.length === 0) return '';
        return `<ul style="margin: 2px 0 0 12px; padding: 0; font-size: 8.5pt;">${lines.map(line => `<li>${line.startsWith('•') || line.startsWith('-') ? line.substring(1).trim() : line.trim()}</li>`).join('')}</ul>`;
    }

    // Live Preview Logic
    function updatePreview() {
        const form = document.getElementById('cv-form');
        const formData = new FormData(form);
        
        // Personal
        const name = document.getElementById('in-name').value;
        const phone = document.getElementById('in-phone').value;
        const email = document.getElementById('in-email').value;
        const linkedin = document.getElementById('in-linkedin').value;
        const website = document.getElementById('in-website').value;
        const address = document.getElementById('in-address').value;
        const summary = document.getElementById('in-summary').value;

        document.getElementById('p-name').textContent = name || 'NAMA LENGKAP ANDA';
        document.getElementById('p-address').textContent = address || 'Kota, Indonesia';
        document.getElementById('p-summary').textContent = summary;
        document.getElementById('p-summary-section').style.display = summary ? 'block' : 'none';
        
        document.getElementById('p-phone').textContent = phone;
        document.getElementById('p-phone-row').style.display = phone ? 'inline' : 'none';
        document.getElementById('p-email').textContent = email;
        document.getElementById('p-email-row').style.display = email ? 'inline' : 'none';
        document.getElementById('p-linkedin').textContent = linkedin;
        document.getElementById('p-linkedin-row').style.display = linkedin ? 'inline' : 'none';
        document.getElementById('p-website').textContent = website;
        document.getElementById('p-website-row').style.display = website ? 'inline' : 'none';
        
        // Process Dynamic Sections
        const experiences = {};
        const educations = {};
        const organizations = {};
        const skills = [];

        for (let [key, value] of formData.entries()) {
            const expMatch = key.match(/content\[experience\]\[(\d+)\]\[(\w+)\]/);
            if (expMatch) {
                if (!experiences[expMatch[1]]) experiences[expMatch[1]] = {};
                experiences[expMatch[1]][expMatch[2]] = value;
            }
            const eduMatch = key.match(/content\[education\]\[(\d+)\]\[(\w+)\]/);
            if (eduMatch) {
                if (!educations[eduMatch[1]]) educations[eduMatch[1]] = {};
                educations[eduMatch[1]][eduMatch[2]] = value;
            }
            const orgMatch = key.match(/content\[organization\]\[(\d+)\]\[(\w+)\]/);
            if (orgMatch) {
                if (!organizations[orgMatch[1]]) organizations[orgMatch[1]] = {};
                organizations[orgMatch[1]][orgMatch[2]] = value;
            }
            const skillMatch = key.match(/content\[skills\]\[(\d+)\]\[(\w+)\]/);
            if (skillMatch) {
                const idx = skillMatch[1];
                if (!skills[idx]) skills[idx] = {};
                skills[idx][skillMatch[2]] = value;
            }
        }

        // Render Experience
        const pExpList = document.getElementById('p-experience-list');
        pExpList.innerHTML = '';
        let hasExp = false;
        Object.values(experiences).forEach(exp => {
            if (exp.company || exp.role) {
                hasExp = true;
                const start = exp.start_month ? `${MONTHS_ID[parseInt(exp.start_month)-1]} ${exp.start_year || ''}` : '';
                const end = (exp.end_month && exp.end_year) ? `${MONTHS_ID[parseInt(exp.end_month)-1]} ${exp.end_year}` : 'Sekarang';
                pExpList.innerHTML += `
                    <div style="margin-bottom: 8px;">
                        <div style="display:flex;justify-content:space-between;font-weight:bold;font-size:9.5pt;">
                            <span>${exp.company}${exp.location ? ' - ' + exp.location : ''}</span>
                            <span>${start ? start + ' - ' + end : ''}</span>
                        </div>
                        <div style="font-style:italic;font-size:9pt;">${exp.role || ''}</div>
                        ${renderBullets(exp.desc)}
                    </div>
                `;
            }
        });
        document.getElementById('p-experience-section').style.display = hasExp ? 'block' : 'none';

        // Render Education
        const pEduList = document.getElementById('p-education-list');
        pEduList.innerHTML = '';
        let hasEdu = false;
        Object.values(educations).forEach(edu => {
            if (edu.school) {
                hasEdu = true;
                const start = edu.start_month ? `${MONTHS_ID[parseInt(edu.start_month)-1]} ${edu.start_year || ''}` : '';
                const end = edu.end_month ? `${MONTHS_ID[parseInt(edu.end_month)-1]} ${edu.end_year || ''}` : '';
                pEduList.innerHTML += `
                    <div style="margin-bottom: 8px;">
                        <div style="display:flex;justify-content:space-between;font-weight:bold;font-size:9.5pt;">
                            <span>${edu.school}${edu.location ? ' - ' + edu.location : ''}</span>
                            <span>${start ? start + ' - ' + (end || 'Sekarang') : ''}</span>
                        </div>
                        <div style="font-size:9pt;">
                            ${edu.degree_level || ''}${edu.major ? ' of ' + edu.major : ''}
                            ${edu.gpa ? ' | IPK: ' + edu.gpa + '/' + (edu.gpa_max || '4.00') : ''}
                        </div>
                        ${renderBullets(edu.activities)}
                    </div>
                `;
            }
        });
        document.getElementById('p-education-section').style.display = hasEdu ? 'block' : 'none';

        // Render Organization
        const pOrgList = document.getElementById('p-organization-list');
        pOrgList.innerHTML = '';
        let hasOrg = false;
        Object.values(organizations).forEach(org => {
            if (org.name) {
                hasOrg = true;
                const start = org.start_month ? `${MONTHS_ID[parseInt(org.start_month)-1]} ${org.start_year || ''}` : '';
                const end = org.current ? 'Sekarang' : (org.end_month ? `${MONTHS_ID[parseInt(org.end_month)-1]} ${org.end_year || ''}` : '');
                pOrgList.innerHTML += `
                    <div style="margin-bottom: 8px;">
                        <div style="display:flex;justify-content:space-between;font-weight:bold;font-size:9.5pt;">
                            <span>${org.name}${org.location ? ' - ' + org.location : ''}</span>
                            <span>${start ? start + (end ? ' - ' + end : '') : ''}</span>
                        </div>
                        <div style="font-style:italic;font-size:9pt;">${org.role || ''}</div>
                        ${renderBullets(org.desc)}
                    </div>
                `;
            }
        });
        document.getElementById('p-organization-section').style.display = hasOrg ? 'block' : 'none';

        // Render Skills List
        const pSkillsList = document.getElementById('p-skills-list');
        pSkillsList.innerHTML = '';
        let hasSkill = false;
        skills.forEach(skill => {
            if (skill.detail) {
                hasSkill = true;
                pSkillsList.innerHTML += `<div style="font-size:9pt;margin-bottom:2px;"><strong>${skill.category}:</strong> ${skill.detail}</div>`;
            }
        });
        // Also check if languages exists
        const languages = formData.get('content[other][languages]');
        if (languages) {
            hasSkill = true;
            pSkillsList.innerHTML += `<div style="font-size:9pt;margin-bottom:2px;"><strong>Languages:</strong> ${languages}</div>`;
        }
        document.getElementById('p-skills-section').style.display = hasSkill ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        addRow('experience');
        document.querySelectorAll('#step-1 input, #step-1 textarea, #step-5 input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
        updatePreview();
    });
</script>
@endsection
