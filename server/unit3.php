<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 3: การจัดการผู้ใช้งานและสิทธิ์ (User & Permission)</title>
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 3 (สัปดาห์ที่ 3)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">การจัดการผู้ใช้งานและสิทธิ์ (User & Permission)</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เรียนรู้ระบบความปลอดภัย Multi-user การคำนวณสิทธิ์ rwx แบบสัญลักษณ์และตัวเลข พร้อมการคุมความปลอดภัยไฟล์องค์กร</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: โครงสร้างความปลอดภัยของ Linux</h3>

                    <h4>1. ระบบ Multi-user และระบบสิทธิ์ความเป็นเจ้าของ (Ownership)</h4>
                    <p>Linux ถูกออกแบบมาให้เป็นระบบปฏิบัติการที่รองรับผู้ใช้หลายคนพร้อมกัน (Multi-user) เพื่อความปลอดภัย ทุกไฟล์และโฟลเดอร์ในระบบจึงต้องระบุ "เจ้าของ" เสมอ โดยจะแบ่งระดับผู้เกี่ยวข้องออกเป็น 3 กลุ่ม:</p>
                    <ul style="padding-left: 20px;">
                        <li><strong>User (u):</strong> ผู้ที่เป็นเจ้าของไฟล์โดยตรง (มักจะเป็นคนสร้างไฟล์นั้นขึ้นมา)</li>
                        <li><strong>Group (g):</strong> กลุ่มของผู้ใช้งานที่มีสิทธิ์ร่วมกันเข้าถึงไฟล์ตามแผนกหรือหน้าที่</li>
                        <li><strong>Other (o):</strong> บุคคลอื่นๆ ทั้งหมดในระบบที่ไม่ได้อยู่ในสองกลุ่มแรก (สาธารณะ)</li>
                    </ul>

                    <h4 style="margin-top: 25px;">2. กลไกสิทธิ์ผู้ใช้ rwx และรหัสสัญลักษณ์</h4>
                    <p>เมื่อเราใช้คำสั่ง <code>ls -l</code> สังเกตบล็อกหน้าสุด เช่น <code>-rwxr-xr--</code> สิทธิ์จะถูกระบุไว้ 3 รูปแบบหลัก:</p>
                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px; text-align: center;">สัญลักษณ์</th>
                                <th style="padding: 10px;">ความหมายสำหรับ "ไฟล์"</th>
                                <th style="padding: 10px;">ความหมายสำหรับ "โฟลเดอร์"</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><strong>r</strong> (Read)</td>
                                <td>เปิดอ่านหรือดูเนื้อหาข้อมูลในไฟล์ได้</td>
                                <td>ใช้คำสั่ง <code>ls</code> เพื่อเปิดดูรายชื่อไฟล์ข้างในได้</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><strong>w</strong> (Write)</td>
                                <td>แก้ไข บันทึก หรือลบเนื้อหาในไฟล์ได้</td>
                                <td>สร้าง ลบ หรือเปลี่ยนชื่อไฟล์ในโฟลเดอร์นั้นได้</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><strong>x</strong> (Execute)</td>
                                <td>สั่งรันไฟล์นั้นให้ทำงานเสมือนเป็นโปรแกรม</td>
                                <td>ใช้คำสั่ง <code>cd</code> เพื่อทะลุเข้าสู่โฟลเดอร์นั้นได้</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4 style="margin-top: 25px;">3. การคำนวณเลขฐานแปด (Octal Permission)</h4>
                    <p>นอกจากการใช้สัญลักษณ์ rwx แล้ว เพื่อความรวดเร็วผู้ดูแลระบบนิยมแปลงค่าสิทธิ์เป็นตัวเลขฐานแปด 3 หลัก โดยการนำค่าน้ำหนักมารวมกัน <strong>(r = 4, w = 2, x = 1)</strong>:</p>

                    <div class="analogy-box" style="background: #eff6ff; border-left: 4px solid #2563eb;">
                        <strong>🧮 ตัวอย่างการถอดรหัสเลขชุด:</strong>
                        <ul style="margin-top: 5px; padding-left: 20px; list-style-type: none;">
                            <li>• <strong>7</strong> (4+2+1) = <code>rwx</code> (ทำได้ทุกอย่าง)</li>
                            <li>• <strong>6</strong> (4+2+0) = <code>rw-</code> (อ่านและเขียน แต่ห้ามรัน)</li>
                            <li>• <strong>5</strong> (4+0+1) = <code>r-x</code> (อ่านและรัน แต่ห้ามแก้ไขเนื้อหา)</li>
                            <li>• <strong>4</strong> (4+0+0) = <code>r--</code> (อ่านได้อย่างเดียว)</li>
                        </ul>
                        <p style="margin: 10px 0 0 0; font-weight: bold; color: #1e40af;">คำสั่งยอดนิยม <code>chmod 755</code> แปลว่า เจ้าของทำได้หมด (7), กลุ่มอ่านและเข้าโฟลเดอร์ได้ (5), คนอื่นอ่านและเข้าโฟลเดอร์ได้ (5)</p>
                    </div>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ: คำสั่งจัดการระบบสิทธิ์แอดมิน</h3>
                    <p>คำสั่งสำหรับจัดการระบบผู้ใช้งานและการเปลี่ยนโครงสร้างสิทธิ์ (จำเป็นต้องใช้ <code>sudo</code> ร่วมด้วยเสมอเนื่องจากเป็นงานระดับระบบ):</p>

                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">👤 <code>groupadd</code> : สร้างกลุ่มผู้ใช้งานใหม่ เช่น <code>sudo groupadd it_dept</code></li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">👤 <code>useradd</code> : เพิ่มผู้ใช้งานใหม่เข้าสู่ระบบเซิร์ฟเวอร์ โดยนิยมใส่ <code>-m</code> เพื่อสร้างโฟลเดอร์โฮม และ <code>-g</code> เพื่อระบุกลุ่ม</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">👤 <code>passwd</code> : กำหนดหรือเปลี่ยนรหัสผ่านให้กับบัญชีผู้ใช้</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">🔒 <code>chmod</code> (Change Mode): เปลี่ยนแปลงสิทธิ์การเข้าถึงไฟล์/โฟลเดอร์</li>
                        <li style="padding: 10px;">🏷️ <code>chown</code> (Change Ownership): เปลี่ยนแปลงสิทธิ์ผู้เป็นเจ้าของไฟล์หรือกลุ่มเจ้าของไฟล์</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🧪 Hands-on Lab: การจำลองระบบสิทธิ์ความปลอดภัยพนักงานองค์กร</h3>
                    <div class="assignment-box">
                        <strong>🎯 โจทย์ปฏิบัติ:</strong> จงสร้างระบบเพื่อรองรับพนักงานใหม่แผนกไอทีชื่อ <strong>somchai</strong> โดยจัดให้อยู่ในกลุ่ม <strong>it_dept</strong> และกำหนดให้โฟลเดอร์เก็บแผนการพัฒนาของบริษัท คนนอกห้ามอ่านห้ามเข้าเด็ดขาด
                    </div>

                    <h4 style="margin-top: 20px;">ขั้นตอนการปฏิบัติภารกิจ:</h4>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 1</span>
                        <p>สร้างกลุ่มแผนก <code>it_dept</code> และเพิ่มผู้ใช้งานชื่อ <code>somchai</code> เข้าไปผูกไว้กับกลุ่มนี้ พร้อมทั้งตั้งรหัสผ่านให้เรียบร้อย</p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>sudo groupadd it_dept
sudo useradd -m -g it_dept somchai
sudo passwd somchai</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 2</span>
                        <p>ไปที่พาทโฟลเดอร์ขยะ <code>/tmp</code> สร้างโฟลเดอร์ชื่อ <code>it_project</code> พร้อมสร้างไฟล์ความลับไว้ภายใน</p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>cd /tmp
mkdir it_project
echo "Confidential Data 2026" > it_project/secret.txt
ls -l</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 3</span>
                        <p>เปลี่ยนเจ้าของโฟลเดอร์ให้เป็นของ <code>somchai</code> และกลุ่ม <code>it_dept</code> จากนั้นปรับสิทธิ์ด้วยเลขฐานแปดให้คนนอก (Other) หมดสิทธิ์ยุ่งกับข้อมูลนี้อย่างเด็ดขาด</p>
                        <div class="code-window">
                            <div class="code-header">
                                <span class="code-lang">Bash / Terminal</span>
                            </div>
                            <pre>sudo chown -R somchai:it_dept it_project
sudo chmod 750 it_project
sudo chmod 640 it_project/secret.txt
ls -la it_project/</pre>
                        </div>
                        <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;">⚠️ <em>ผลลัพธ์ของโฟลเดอร์ <code>it_project</code> ต้องแสดงเป็น <code>drwxr-x---</code> ซึ่งหมายความว่าคนนอกระบบ (Other) จะไม่สามารถสั่ง <code>cd</code> เข้ามาหรือส่องดูไฟล์ใดๆ ได้เลย</em></p>
                    </div>

                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 3<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> ตรวจสอบสถานะการคำนวณสิทธิ์ระบบพนักงานสำเร็จ (5 คะแนน) และสมุดบันทึกสรุปตัวเลขฐานแปด (5 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #ef4444;">
                    <h4>🚨 ข้อควรระวังระดับวิชาชีพ</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        ห้ามใช้คำสั่ง <strong><code>chmod 777</code></strong> กับไฟล์หรือไดเรกทอรีในระบบงานจริงโดยเด็ดขาด เนื่องจากเป็นการเปิดโอกาสให้ผู้ใช้งานทุกคนในระบบรวมถึงผู้ไม่หวังดี (Hacker) สามารถเข้ามาเขียนไฟล์ แก้ไข ลบ หรือฝังมัลแวร์ในเซิร์ฟเวอร์เราได้โดยง่าย
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>