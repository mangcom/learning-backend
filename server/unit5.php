<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 5: การจัดการ Package และ Service (Daemon Control)</title>
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 5 (สัปดาห์ที่ 5)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">การจัดการ Package และ Service (Daemon Control)</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เข้าใจระบบคลังซอฟต์แวร์กลาง กลไกจัดการ Dependency และการควบคุมตรวจสอบสถานะกระบวนการทำงานเบื้องหลัง (Daemon) บนลินุกซ์</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: กลไกคลังโปรแกรม และ วงจรชีวิตของ Service</h3>

                    <h4>1. คลังโปรแกรม (Repository) และกลไกของ APT</h4>
                    <p>ในระบบปฏิบัติการ Linux รูปแบบการลงโปรแกรมจะแตกต่างจาก Windows ที่ต้องไปหาดาวน์โหลดไฟล์ .exe จากเว็บต่างๆ ซึ่งเสี่ยงต่อมัลแวร์ แต่ Linux จะใช้ระบบ <strong>Repository (คลังโปรแกรมกลาง)</strong> ที่ถูกตรวจสอบความปลอดภัยโดยผู้พัฒนาแจกจ่ายโดยตรง เสมือน App Store หรือ Play Store</p>
                    <p>เครื่องมือ <strong>APT (Advanced Package Tool)</strong> บน Ubuntu จะทำหน้าที่ไปส่องดูรายชื่อโปรแกรมอัปเดตจากไฟล์ต้นทางที่ชื่อว่า <code>/etc/apt/sources.list</code> เพื่อตรวจสอบว่าในเซิร์ฟเวอร์มีโปรแกรมรุ่นใหม่ให้ดาวน์โหลดแล้วหรือยัง</p>

                    <h4 style="margin-top: 25px;">2. ปัญหาการพึ่งพากันระหว่างซอฟต์แวร์ (Dependency)</h4>
                    <p>โปรแกรมในระบบ Linux มักถูกเขียนแยกส่วนเป็นชิ้นเล็กชิ้นน้อยเพื่อไม่ให้ซ้ำซ้อนกัน เรียกว่า <strong>Dependency (การพึ่งพา)</strong> ตัวอย่างเช่น หากต้องการติดตั้งโปรแกรมเว็บเซิร์ฟเวอร์ A โปรแกรมนั้นอาจต้องการโมดูลถอดรหัสความปลอดภัย B และโปรแกรมจัดการตัวอักษร C ก่อน หากไม่มีระบบจัดการที่ดี แอดมินต้องไล่ดาวน์โหลดทีละชิ้นจนเกิดอาการพังพินาศที่เรียกว่า <em>Dependency Hell</em> แต่เครื่องมือ <code>apt</code> จะเข้ามาทำหน้าที่คำนวณและดึงชิ้นส่วนที่เกี่ยวข้องมาประกอบให้โดยอัตโนมัติ</p>

                    <h4 style="margin-top: 25px;">3. ทำความเข้าใจ Service และ Daemon</h4>
                    <p><strong>Daemon (ดีมอน)</strong> คือ กระบวนการทำงาน (Process) ของระบบปฏิบัติการที่รันอยู่ "เบื้องหลัง" (Background) ตลอดเวลา โดยไม่มีหน้าต่างโปรแกรมโผล่ขึ้นมาให้เราเห็น และมักลงท้ายชื่อด้วยตัวอักษร <strong>d</strong> เช่น <code>sshd</code> (ดูแลระบบ SSH), <code>apache2</code> / <code>nginx</code> (ดูแลระบบเว็บ) ทำหน้าที่คอยรับฟังคิวการร้องขอข้อมูลจากผู้ใช้ผ่านพอร์ตเครือข่าย</p>

                    <p>ระบบควบคุมหลักของ Ubuntu ในปัจจุบันเรียกว่า <strong>systemd</strong> ซึ่งรับผิดชอบดูแลวงจรชีวิต (Lifecycle) ของดีมอนทั้งหมดผ่านคำสั่งควบคุมสถานะ</p>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ: ชุดคำสั่งควบคุมแอปพลิเคชันและบริการ</h3>

                    <h4>1. หมวดคำสั่งจัดการแอปพลิเคชัน (APT Command)</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📦 <code>sudo apt update</code> : อัปเดตรายชื่อและเวอร์ชันไฟล์ในคลังข้อมูล (ยังไม่ได้อัปเดตตัวแอปจริง)</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📦 <code>sudo apt upgrade -y</code> : เริ่มทำการดาวน์โหลดและติดตั้งตัวอัปเดตโปรแกรมทุกตัวในเครื่องให้ใหม่ล่าสุด</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📦 <code>sudo apt install [package_name]</code> : ดาวน์โหลดและติดตั้งโปรแกรมพร้อมจัดการตรวจสอบคำนวณ Dependency</li>
                        <li style="padding: 10px; border-bottom: 1px dashed #e2e8f0;">📦 <code>sudo apt remove / purge [package_name]</code> : ถอนการติดตั้งโปรแกรมออก (Purge จะลบไฟล์คอนฟิกทั้งหมดออกไปด้วย)</li>
                    </ul>

                    <h4 style="margin-top: 25px;">2. หมวดคำสั่งควบคุมระบบบริการ (Systemctl Command)</h4>
                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px; width: 35%;">คำสั่งควบคุม</th>
                                <th style="padding: 10px;">ผลลัพธ์การทำงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>sudo systemctl start [service]</code></td>
                                <td>สั่งให้โปรแกรมเริ่มทำงานในเบื้องหลังทันที</td>
                            </tr>
                            <tr>
                                <td><code>sudo systemctl stop [service]</code></td>
                                <td>สั่งปิดการทำงานของบริการนั้นย้อนหลัง</td>
                            </tr>
                            <tr>
                                <td><code>sudo systemctl restart [service]</code></td>
                                <td>สั่งปิดแล้วเปิดใหม่ทันที (นิยมใช้หลังแก้ไขไฟล์ตั้งค่าโปรแกรม)</td>
                            </tr>
                            <tr>
                                <td><code>sudo systemctl status [service]</code></td>
                                <td>ส่องดูรายละเอียด ล็อกขยะการรัน และสถานะว่าตายหรือยังรันอยู่ (Active/Inactive)</td>
                            </tr>
                            <tr>
                                <td><code>sudo systemctl enable [service]</code></td>
                                <td>ตั้งค่าให้เปิดใช้งานบริการนี้ "อัตโนมัติ" ทุกครั้งเมื่อมีการเปิดเครื่องเซิร์ฟเวอร์</td>
                            </tr>
                            <tr>
                                <td><code>sudo systemctl disable [service]</code></td>
                                <td>ยกเลิกการเปิดอัตโนมัติเมื่อเปิดเครื่อง (ต้องมาสั่งกดเปิดเองแมนนวล)</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4 style="margin-top: 25px;">3. เครื่องมือส่องดูบันทึกเหตุกาณ์ระบบ (Journalctl)</h4>
                    <p>เวลาเกิดปัญหาโปรแกรมรันไม่ขึ้น (Crash) แอดมินจะใช้เครื่องมือ <strong><code>journalctl</code></strong> ในการเจาะดูรายงานข้อผิดพลาดระดับลึกของซอฟต์แวร์ย่อย:</p>
                    <ul>
                        <li><code>journalctl -u nginx.service</code> : ตรวจดูเฉพาะล็อกการทำงานของเว็บเซิร์ฟเวอร์ Nginx</li>
                        <li><code>journalctl -f</code> : เปิดดูหน้าล็อกแบบเรียลไทม์ (เมื่อมีบั๊กเกิดขึ้นใหม่ ล็อกจะเด้งฟีดมาบนหน้าจอทันที)</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🧪 Hands-on Lab: การบริหารจัดการและแก้ปัญหาระบบบริการ</h3>
                    <div class="assignment-box">
                        <strong>🎯 โจทย์ปฏิบัติ:</strong> ผู้เรียนต้องทำการติดตั้งเว็บเซิร์ฟเวอร์แบบเบาที่ชื่อว่า <strong>Nginx</strong> จากนั้นให้บริหารคุมระบบวงจรชีวิต ปิดการรัน และทดลองส่องบันทึกข้อผิดพลาดเพื่อสรุปใบงานส่งอาจารย์
                    </div>

                    <h4 style="margin-top: 20px;">ขั้นตอนปฏิบัติการ:</h4>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 1</span>
                        <p>อัปเดตดัชนีคลังข้อมูล และทำการดาวน์โหลดติดตั้งแอปพลิเคชัน <code>nginx</code> พร้อมออปชันยินยอมติดตั้ง</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo apt update
sudo apt install nginx -y</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 2</span>
                        <p>ตรวจสอบดูว่าระบบดึงแพลตฟอร์มบริการขึ้นมาทำงานสำเร็จหรือไม่ โดยดูจากสถานะ <code>active (running)</code> สีเขียว</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo systemctl status nginx</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 3</span>
                        <p>ทดลองปิดบริการเว็บบนระบบเซิร์ฟเวอร์ แล้วทำการส่องเช็คสถานะอีกครั้งเพื่อสังเกตความเปลี่ยนแปลง</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo systemctl stop nginx
sudo systemctl status nginx</pre>
                        </div>
                        <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;">⚠️ <em>สถานะจะเปลี่ยนกลายเป็นสีเทาคำว่า <code>inactive (dead)</code> ซึ่งส่งผลให้บุคคลภายนอกไม่สามารถเรียกเข้าหน้าเว็บเซิร์ฟเวอร์ของเครื่องนี้ได้อีก</em></p>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 4</span>
                        <p>สั่งเปิดบริการคืนกลับมา พร้อมล็อกให้โปรแกรมรันขึ้นทำงานเองอัตโนมัติเมื่อเครื่องคอมพิวเตอร์โดนรีบูตเปิดใหม่ในอนาคต</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo systemctl start nginx
sudo systemctl enable nginx</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 5</span>
                        <p>เจาะลึกดูประวัติประโยคบันทึกการทำงานย้อนหลัง 20 บรรทัดสุดท้ายของระบบบริการเพื่อใช้ประกอบการรายงานสรุปผล</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>journalctl -u nginx -n 20 --no-pager</pre>
                        </div>
                    </div>

                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 5<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> คะแนนสอบปฏิบัติสั่งเปิด/ปิด/ล็อกระบบบริการได้ถูกต้อง (5 คะแนน) บันทึกสรุปล็อกบั๊ก (5 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #ef4444;">
                    <h4>🚨 บั๊กร้ายแรง: ปัญหากระบวนการชนพอร์ต (Port Conflict)</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        หากนักศึกษาพยายามสั่ง <code>systemctl start apache2</code> ในขณะที่ระบบยังมีโปรแกรม <code>nginx</code> เปิดใช้งานอยู่ ตัวบริการจะเปิดไม่ขึ้น (Failed) และแจ้งรหัสความพังใน <code>journalctl</code> ทันที เนื่องจากทั้งสองโปรแกรมเป็นเว็บเซิร์ฟเวอร์ที่แย่งใช้พอร์ตบริการเลขเดียวกันคือ **Port 80** แอดมินต้องปิดตัวใดตัวหนึ่งก่อนเสมอครับ
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>