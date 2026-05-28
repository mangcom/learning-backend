<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 2: Linux Command Line และโครงสร้างระบบไฟล์</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body style="background-color: #f8fafc;">

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background: #0f172a; color: #fff; padding: 40px 0 65px 0;">
        <div class="container">
            <a href="index.php" class="back-link">
                <span class="arrow-icon">⬅</span> <span>กลับสู่หน้าหลักวิชา Linux Server</span>
            </a>
            <div style="margin-top: 15px;">
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 2 (สัปดาห์ที่ 2)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">Linux Command Line และโครงสร้างระบบไฟล์</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เรียนรู้มาตรฐานระบบไฟล์พาทิศทาง, การจัดการไอโอสตรีม และทักษะการควบคุมระบบผ่าน CLI</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: โครงสร้างและแนวคิดสำคัญ</h3>

                    <h4>1. โครงสร้างระบบไฟล์ตามมาตรฐาน FHS (Filesystem Hierarchy Standard)</h4>
                    <p>ระบบปฏิบัติการ Linux ไม่มีการใช้ไดรฟ์ C: หรือ D: เหมือน Windows แต่ทุกอย่างจะเริ่มต้นจากรากฐานเดียวคือ <strong>Root Directory (/)</strong> ซึ่งเปรียบเหมือนโคนต้นไม้ และมีโฟลเดอร์ย่อยทำหน้าที่เฉพาะทางอย่างชัดเจนตามมาตรฐานสากล:</p>

                    <div class="analogy-box">
                        <strong>💡 สรุปพาร์ทไดเรกทอรีสำคัญที่ผู้ดูแลระบบต้องจำ:</strong>
                        <ul style="margin-top: 5px; padding-left: 20px;">
                            <li><code>/</code> (Root): จุดเริ่มต้นสูงสุดของระบบไฟล์ทั้งหมด</li>
                            <li><code>/etc</code>: แหล่งเก็บไฟล์การตั้งค่า (Configuration Files) ของระบบและโปรแกรมทั้งหมด</li>
                            <li><code>/home</code>: พื้นที่เก็บข้อมูลส่วนตัวของผู้ใช้งานทั่วไป (เช่น /home/somchai)</li>
                            <li><code>/root</code>: พื้นที่เก็บข้อมูลส่วนตัวของสิทธิ์ผู้ดูแลระบบสูงสุด (Superuser)</li>
                            <li><code>/var/log</code>: จุดเก็บไฟล์บันทึกเหตุการณ์และประวัติการทำงาน (Logs) ของเซิร์ฟเวอร์</li>
                            <li><code>/bin</code> และ <code>/sbin</code>: ที่เก็บคำสั่งและโปรแกรมระบบที่จำเป็นในการบูตเครื่อง</li>
                        </ul>
                    </div>

                    <h4 style="margin-top: 25px;">2. ทำความเข้าใจ Shell และ Bash</h4>
                    <p>เนื่องจาก Kernel (แกนกลางระบบ) คุยเฉพาะภาษาเครื่อง 0 กับ 1 มนุษย์จึงไม่สามารถสั่งการตรงๆ ได้ จึงต้องมีตัวกลาง:</p>
                    <ul>
                        <li><strong>Shell:</strong> คือโปรแกรมประยุกต์ที่ทำหน้าที่เป็น "เปลือกหุ้ม" คอยรับคำสั่งที่เป็นข้อความจากผู้ใช้ นำไปแปลความหมาย แล้วส่งต่อไปให้ Kernel ทำงาน</li>
                        <li><strong>Bash (Bourne Again Shell):</strong> คือประเภทของ Shell ยอดนิยมมาตรฐานที่เปิดใช้งานเป็นค่าเริ่มต้นบน Ubuntu Server และ Linux ส่วนใหญ่ในโลก</li>
                    </ul>

                    <h4 style="margin-top: 25px;">3. กลไกสตรีมข้อมูลมาตรฐาน (Standard Streams)</h4>
                    <p>เวลาเราทำงานผ่าน Command Line โปรแกรมใน Linux จะทำงานร่วมกับช่องทางเข้าออกข้อมูล 3 เส้นทางหลัก (I/O Redirection):</p>
                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px;">ชื่อสตรีม</th>
                                <th style="padding: 10px;">File Descriptor</th>
                                <th style="padding: 10px;">หน้าที่การทำงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>stdin</strong> (Standard Input)</td>
                                <td>0</td>
                                <td>ช่องทางรับข้อมูลเข้า (ปกติมาจากคีย์บอร์ด)</td>
                            </tr>
                            <tr>
                                <td><strong>stdout</strong> (Standard Output)</td>
                                <td>1</td>
                                <td>ช่องทางส่งผลลัพธ์ปกติ (ออกทางหน้าจอ Terminal)</td>
                            </tr>
                            <tr>
                                <td><strong>stderr</strong> (Standard Error)</td>
                                <td>2</td>
                                <td>ช่องทางส่งข้อความแจ้งเตือนเมื่อเกิดข้อผิดพลาด (ออกหน้าจอแยกจากไอโอปกติ)</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ: คำสั่งควบคุม CLI ที่จำเป็น</h3>
                    <p>ชุดคำสั่งพื้นฐานที่ผู้ดูแลระบบต้องใช้ความชำนาญในการเคลื่อนที่และบริหารจัดการไฟล์บนเซิร์ฟเวอร์:</p>

                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>pwd</code> (Print Working Directory): ตรวจสอบว่าปัจจุบันเรายืนอยู่ที่โฟลเดอร์ไหน</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>ls</code> (List): แสดงรายชื่อไฟล์และโฟลเดอร์ (นิยมใช้ <code>ls -la</code> เพื่อดูไฟล์ซ่อนและสิทธิ์การเข้าถึง)</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>cd</code> (Change Directory): ย้ายตำแหน่งโฟลเดอร์ เช่น <code>cd /etc</code> หรือ <code>cd ..</code> เพื่อถอยกลับหนึ่งชั้น</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>mkdir</code> (Make Directory): สร้างโฟลเดอร์ใหม่</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>cp</code> (Copy): คัดลอกไฟล์/โฟลเดอร์ (หากคัดลอกโฟลเดอร์ต้องใช้ <code>cp -r</code>)</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>mv</code> (Move / Rename): ย้ายตำแหน่งไฟล์ หรือใช้ในการเปลี่ยนชื่อไฟล์</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>rm</code> (Remove): ลบไฟล์ (หากลบโฟลเดอร์ที่มีของอยู่ภายในทั้งหมดต้องใช้คำสั่งอันตราย <code>rm -rf</code>)</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📌 <code>cat</code> (Concatenate): อ่านและแสดงเนื้อหาภายในไฟล์ออกมาบนหน้าจอทั้งหมด</li>
                        <li style="padding: 10px;">📌 <code>nano</code>: โปรแกรมแก้ไขไฟล์ข้อความ (Text Editor) พื้นฐานบนหน้าจอ Terminal</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🧪 Hands-on Lab: การจัดโครงสร้างโฟลเดอร์องค์กร</h3>
                    <div class="assignment-box">
                        <strong>🎯 สถานการณ์จำลอง:</strong> มอบหมายงานให้ทำระบบจัดการไดเรกทอรีจัดเก็บข้อมูลของแผนกต่างๆ ในหน่วยงาน โดยมีโครงสร้างภายใต้โฟลเดอร์กลางชื่อ <code>/company</code> แยกย่อยเป็นแผนก <code>hr</code>, <code>it</code>, และ <code>sales</code> พร้อมทั้งทำการทดสอบเขียนรายงานสรุปงาน
                    </div>

                    <h4 style="margin-top: 20px;">ขั้นตอนการปฏิบัติตามคำสั่ง:</h4>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 1</span>
                        <p>ย้ายตำแหน่งพาทไปที่ <code>/tmp</code> (โฟลเดอร์ขยะสำหรับฝึกฝน) จากนั้นทำการสร้างโครงสร้างโฟลเดอร์ของบริษัทพร้อมกันทีเดียวด้วยออปชัน <code>-p</code></p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>cd /tmp
mkdir -p company/hr company/it company/sales
ls -l company/</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 2</span>
                        <p>ใช้โปรแกรมพิมพ์ข้อความ <code>nano</code> เพื่อเข้าไปเขียนไฟล์บันทึกรายชื่อพนักงานไอทีในโฟลเดอร์ <code>company/it/staff.txt</code></p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>nano company/it/staff.txt</pre>
                        </div>
                        <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;">⚠️ <em>พิมพ์ชื่อตนเองลงไปในไฟล์ จากนั้นกดปุ่ม <code>Ctrl + O</code> (เซฟ) ตามด้วย <code>Enter</code> และกด <code>Ctrl + X</code> เพื่อออกจากโปรแกรม</em></p>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 3</span>
                        <p>ตรวจสอบความถูกต้องของเนื้อหาโดยใช้คำสั่ง <code>cat</code> และทำการสำรองไฟล์รายชื่อนี้ไปเก็บไว้ที่โฟลเดอร์กลางของฝ่ายทรัพยากรบุคคล (hr)</p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>cat company/it/staff.txt
cp company/it/staff.txt company/hr/backup_it_staff.txt
ls -l company/hr/</pre>
                        </div>
                    </div>

                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 2<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> ผลสำเร็จของโครงสร้าง Lab (5 คะแนน) และแบบทดสอบท้ายหน่วย (5 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #f59e0b;">
                    <h4>⚠️ ข้อควรระวังในการใช้ CLI</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        ระบบ Linux เป็นระบบที่ <strong>Case-Sensitive</strong> หมายความว่า ตัวอักษรพิมพ์เล็กและพิมพ์ใหญ่ถือเป็นคนละตัวกัน เช่น <code>FolderA</code> กับ <code>foldera</code> จะอยู่แยกจากกันอย่างสิ้นเชิง และการใช้คำสั่งลบ <code>rm</code> จะไม่มีถังขยะให้กู้คืนเหมือนบนหน้าจอกราฟิก
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>