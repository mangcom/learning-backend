<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลักวิชา: การพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <span class="course-code">💻 รหัสวิชา: 31901-2005 | หลักสูตร ปวส. 2567</span>
            <h2>การพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End</h2>
            <p>(Software Development with Back-End Technology) | โครงสร้าง 1–4–3 (3 หน่วยกิต)</p>

            <button id="openSpecsBtn" class="btn-course-specs" style="margin-top: 15px;">📄 ดูข้อมูลโครงสร้างหลักสูตรและแผนฐานสมรรถนะ</button>
        </div>
    </div>

    <div class="container">
        <div class="course-stats-grid">
            <div class="stat-card">
                <h3>10</h3>
                <p>หน่วยการเรียนรู้</p>
            </div>
            <div class="stat-card">
                <h3>15+1</h3>
                <p>สัปดาห์เรียน + สอบ</p>
            </div>
            <div class="stat-card">
                <h3>75</h3>
                <p>ชั่วโมงเรียนรวม (ป) 60 (ท) 15</p>
            </div>
            <div class="stat-card">
                <h3>3</h3>
                <p>หน่วยกิต (1-4-3)</p>
            </div>
        </div>

        <div class="main-content-layout" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 40px;">

            <div class="units-column">
                <h3 class="section-title">📂 รายชื่อหน่วยการเรียนรู้ (สัปดาห์ที่ 1 - 15)</h3>
                <div class="unit-grid-layout" style="display: flex; flex-direction: column; gap: 20px;">

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 1</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 1 (5 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Introduction to Back-End Development</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">บทนำสู่สถาปัตยกรรม Client-Server, กลไก Request-Response ผ่านโปรโตคอล HTTP และการตั้งค่า Node.js</p>
                        </div>
                        <a href="unit1.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 2</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 2 (5 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Advanced JavaScript ES6+ for Back-End</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">ไวยากรณ์ JavaScript ยุคใหม่ Arrow Functions, Modules และกลไกควบคุมแบบ Asynchronous</p>
                        </div>
                        <a href="unit2.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 3</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 3 (5 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Node.js Fundamentals & Core Modules</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การทำงานแบบ Non-blocking I/O และระบบจัดการไฟล์ภายใน (fs module) ควบคุมผ่านระบบ npm</p>
                        </div>
                        <a href="unit3.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 4</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 4-5 (10 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Express.js Architecture & Routing</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">โครงสร้าง Express.js Framework, การจัดการโครงสร้างเส้นทาง (Routing) และรับส่งค่าผ่าน URL Parameter</p>
                        </div>
                        <a href="unit4.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 5</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 6-7 (10 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Middleware & Request Data Parsing</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การประยุกต์ใช้งานและสร้าง Custom Middleware ดักจับข้อมูล รวมถึงกระบวนการ Parse ข้อมูลบอดี้เข้าระบบ</p>
                        </div>
                        <a href="unit5.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 6</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 8 (5 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">RESTful API Design Best Practices</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การออกแบบโครงสร้าง Endpoint ที่ดีตามมาตรฐานสากล ควบคุมผ่าน HTTP Status Code และทดสอบผ่าน Postman</p>
                        </div>
                        <a href="unit6.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 7</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 9-10 (10 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Database Integration (SQL & NoSQL)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การเชื่อมต่อและเขียนโปรแกรมจัดการฐานข้อมูลสมัยใหม่ การดึง ค้นหา ปรับปรุงข้อมูล (CRUD Operations)</p>
                        </div>
                        <a href="unit7.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 8</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 11-12 (10 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">User Authentication & Security (JWT)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">ระบบการแฮชป้องกันรหัสผ่านผู้ใช้ และการทำระบบสิทธิ์เข้าถึงข้อมูลความปลอดภัยผ่านเทคโนโลยี JSON Web Token</p>
                        </div>
                        <a href="unit8.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 9</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 13-14 (10 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Integration Testing & Error Logging</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การหาจุดผิดพลาดตามบันทึกข้อผิดพลาด (Error Log) ดำเนินการและออกแบบการทดสอบระบบแบบ Integration Test</p>
                        </div>
                        <a href="unit9.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">หน่วยที่ 10</span>
                            <span style="font-size:0.8rem; color:#64748b; margin-left:10px; font-weight:600;">สัปดาห์ที่ 15 (5 ชม.)</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Project Documentation & Deployment</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;">การจัดทำรายงาน คู่มือการใช้งานระบบ และการเตรียมความพร้อมกระบวนการส่งมอบซอฟต์แวร์ให้ใช้งานได้จริง</p>
                        </div>
                        <a href="unit10.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูเนื้อหา ➔</a>
                    </div>

                </div>
            </div>

            <div class="sidebar-column">
                <div class="course-sidebar">

                    <div class="right-sidebar-box pre-requisite">
                        <h3>💡 ความรู้เบื้องต้นก่อนเริ่มเรียน</h3>
                        <ul>
                            <li>📌 มีความเข้าใจพื้นฐานเกี่ยวกับ HTML และการจัดหน้าเว็บไซต์เบื้องต้น</li>
                            <li>📌 เข้าใจไวยากรณ์พื้นฐานของภาษา JavaScript (Variables, Arrays, Objects)</li>
                            <li>📌 สามารถติดตั้งและใช้งานโปรแกรม VS Code และ Terminal ขั้นต้นได้</li>
                            <li>📌 มีความเข้าใจเรื่อง Client-Server Architecture แบบย่อ</li>
                        </ul>
                    </div>
                    <div class="right-sidebar-box">
                        <h3 class="section-title">📊 เกณฑ์การประเมินผลรายวิชา</h3>
                        <p style="font-size:0.9rem; color:#475569; margin-bottom:15px;">การวัดผลสัมฤทธิ์ทางการเรียนวิชาการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End แบ่งสัดส่วนคะแนนออกเป็น 4 ส่วนหลักดังนี้:</p>

                        <table class="grading-table" style="width:100%; border-collapse:collapse; font-size:0.9rem;">
                            <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
                                <th style="padding:10px; text-align:left; color:#0f172a;">ส่วนการประเมิน</th>
                                <th style="padding:10px; text-align:right; color:#0f172a;">สัดส่วน</th>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">📝 1. คุณธรรม จริยธรรม (จิตพิสัย)</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">20%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">✍️ 2. ใบงานปฏิบัติการรายหน่วย</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">40%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">🔥 3. โครงงานวิจัยประยุกต์/ชิ้นงาน</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">20%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">🚀 4. สอบวัดผลสัมฤทธิ์ปลายภาค</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">20%</td>
                            </tr>
                            <tr style="background:#f1f5f9;">
                                <td style="padding:10px; font-weight:bold; color:#0f172a;">คะแนนรวมทั้งสิ้น</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#0f172a;">100%</td>
                            </tr>
                        </table>

                        <div style="margin-top:20px; background:#fef3c7; border-left:4px solid #d97706; padding:12px; border-radius:4px; font-size:0.85rem; color:#78350f;">
                            📝 <strong>สัปดาห์ที่ 16 (สอบปลายภาค):</strong> ทำการประเมินสรุปผลรวม (Summative Assessment) ทดสอบทักษะการ Integration Test และแก้บักโค้ดภาคปฏิบัติจริง
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--  Modal shwo Course -->
        <div id="specsModal" class="custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>📄 เอกสารข้อกำหนดหลักสูตรฐานสมรรถนะรายวิชา</h4>
                    <span class="close-modal-btn">&times;</span>
                </div>
                <div class="modal-body">
                    <table class="info-meta-table">
                        <tr>
                            <td><strong>รายวิชา:</strong></td>
                            <td>การพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End <br> (Software Development with Back-End Technology)</td>
                        </tr>
                        <tr>
                            <td><strong>รหัสวิชา:</strong></td>
                            <td>31901-2005 (โครงสร้างเวลาเรียน 1 - 4 - 3)</td>
                        </tr>
                        <tr>
                            <td><strong>กลุ่มสมรรถนะ:</strong></td>
                            <td>วิชาชีพเฉพาะ (กลุ่มสมรรถนะวิชาชีพพื้นฐาน) | <strong>หมวดวิชา:</strong> วิชาชีพ</td>
                        </tr>
                        <tr>
                            <td><strong>สาขาวิชา:</strong></td>
                            <td>เทคโนโลยีสารสนเทศ | <strong>กลุ่มอาชีพ:</strong> ซอฟต์แวร์และการประยุกต์</td>
                        </tr>
                        <tr>
                            <td><strong>ประเภทวิชา:</strong></td>
                            <td>อุตสาหกรรมดิจิทัลและเทคโนโลยีสารสนเทศ</td>
                        </tr>
                        <tr>
                            <td><strong>หลักสูตร:</strong></td>
                            <td>ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.) พุทธศักราช 2567</td>
                        </tr>
                        <tr>
                            <td><strong>ผู้สอนวิเคราะห์:</strong></td>
                            <td>นายพรชัย ตุ่นแก้ว วิทยฐานะ ชำนาญการ ประจำแผนกวิชา เทคโนโลยีสารสนเทศ</td>
                        </tr>
                        <tr>
                            <td><strong>กลุ่มเป้าหมาย:</strong></td>
                            <td>ผู้เรียนชั้น ปวส. 1 แผนกวิชา เทคโนโลยีสารสนเทศ (ภาคเรียนที่ 1 ปีการศึกษา 2569)</td>
                        </tr>
                        <tr>
                            <td><strong>สถานศึกษา:</strong></td>
                            <td>วิทยาลัยพณิชยการบางนา สถาบันการอาชีวศึกษากรุงเทพมหานคร สำนักงานคณะกรรมการการอาชีวศึกษา กระทรวงศึกษาธิการ</td>
                        </tr>
                        <tr>
                            <td><strong>อ้างอิงมาตรฐานวิชาชีพ:</strong></td>
                            <td>มาตรฐานอาชีพ สถาบันคุณวุฒิวิชาชีพ อาชีพ นักพัฒนาระบบ ระดับ 4</td>
                        </tr>
                    </table>

                    <div class="spec-section-box">
                        <h5>🎯 ฐานสมรรถนะประจำรายวิชา (Competency Base)</h5>
                        <p>พัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End เพื่อออกแบบส่วนติดต่อผู้ใช้ตามหลักการ ด้วยความละเอียด รอบคอบ รับผิดชอบ การสื่อสารและการทำงานเป็นทีม โดยใช้การวิจัยเป็นฐานแบบมีส่วนร่วม</p>
                    </div>

                    <div class="spec-section-box">
                        <h5>🎯 ผลลัพธ์การเรียนรู้ระดับรายวิชา (Course Learning Outcomes)</h5>
                        <p>พัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End เพื่อออกแบบส่วนติดต่อผู้ใช้ตามหลักการ ด้วยความละเอียด รอบคอบ รับผิดชอบ การสื่อสารและการทำงานเป็นทีม</p>
                    </div>

                    <div class="spec-section-box">
                        <h5>🎯 จุดประสงค์รายวิชา (Course Objectives)</h5>
                        <div><strong>เพื่อให้:</strong> </div>
                        <ol>
                            <li>เข้าใจการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End</li>
                            <li>มีทักษะในการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End</li>
                            <li>มีเจตคติและกิจนิสัยที่ดีในการปฏิบัติงานด้วยความละเอียดรอบคอบ รับผิดชอบ การสื่อสาร
                                การคิดเชิงนวัตกรรมและการทำงานเป็นทีม
                            </li>
                            <li>มีความสามารถประยุกต์ใช้หลักการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End ในงานอาชีพ</li>
                        </ol>
                    </div>

                    <div class="spec-section-box">
                        <h5>🎯 สมรรถนะรายวิชา (Course Competencies)</h5>
                        <ol>
                            <li>ประมวลความรู้เกี่ยวกับหลักการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End ตามหลักการ</li>
                            <li>พัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End ตามหลักการและกระบวนการ</li>
                            <li>ทดสอบและแก้ไขข้อผิดพลาดของซอฟต์แวร์ ตามหลักการและกระบวนการ</li>
                            <li>จัดทำคู่มือการใช้งานตามหลักการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Front-End</li>
                            <li>ประยุกต์ใช้หลักการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End ในงานอาชีพ</li>
                        </ol>
                    </div>

                    <div class="spec-section-box">
                        <h5>📖 คำอธิบายรายวิชา (Course Description)</h5>
                        <p style="text-indent: 40px; text-align: justify; line-height: 1.7;">
                            ศึกษาและปฏิบัติเกี่ยวกับหลักการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End ความหมาย ความสำคัญ ประโยชน์ของการพัฒนาซอฟต์แวร์ด้วยเทคโนโลยี Back-End เลือกใช้ภาษาและเทคโนโลยีสมัยใหม่ในการพัฒนา (Vue/React/Angular/ฯลฯ ) การทำงานร่วนกันเป็นทีม(Version Control System) ดำเนินการพัฒนาโปรแกรมแบบ Integration ตกแต่งเอกสารด้วย UI Component Library/CSS Framework เขียนโปรแกรมเชื่อมต่อ RESTful API/Web Services เขียนโปรแกรมติดต่อฐานข้อมูลแบบ SQL/NoSQL การทำ Authentication ในรูปแบบ JSON Web Token/Session หาจุดผิดพลาด ตามบันทึกข้อผิดพลาด แก้ไขข้อผิดพลาดของโปรแกรม ทดสอบการแก้ไขข้อผิดพลาดของโปรแกรม อ่าน Functional/Program Specification/UML เขียนโปรแกรมตาม Functional/Program Specification/ UML ออกแบบการทดสอบ Integration Test ดำเนินการทดสอบโปรแกรมแบบ Integration Test จัดทำรายงาน ศึกษาการใช้งาน โปรแกรมที่พัฒนาขึ้น จัดทำคู่มือการใช้งานโปรแกรม ตรวจสอบความถูกต้องของคู่มือการใช้งานโปรแกรม การส่งมอบซอฟต์แวร์เพื่อให้สามารถใช้งานได้
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modal = document.getElementById("specsModal");
                const btn = document.getElementById("openSpecsBtn");
                const span = document.getElementsByClassName("close-modal-btn")[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                    document.body.style.overflow = "hidden";
                }
                span.onclick = function() {
                    modal.style.display = "none";
                    document.body.style.overflow = "auto";
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                        document.body.style.overflow = "auto";
                    }
                }
            });
        </script>
        <script src="assets/js/script.js"></script>
</body>

</html>