<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "server"; // เปิดสถานะเมนูที่วิชา Server Linux
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลักวิชา: ระบบปฏิบัติการเครื่องแม่ข่าย (Network Operating System for Server)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <!-- <div class="page-header"> -->
    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <span class="course-code">💻 รหัสวิชา: 31901-2002 | หลักสูตร ปวส. กลุ่มสมรรถนะวิชาชีพพื้นฐาน</span>
            <h2>ระบบปฏิบัติการเครื่องแม่ข่าย</h2>
            <p>(Network Operating System for Server) | เรียนรู้ผ่านแกนหลัก Ubuntu Server 24.04 LTS</p>

            <button id="openSpecsBtn" class="btn-course-specs" style="margin-top: 15px;">📄 ดูข้อมูลโครงสร้างหลักสูตรและแผนฐานสมรรถนะ</button>
        </div>
    </div>

    <div class="container">
        <div class="course-stats-grid">
            <div class="stat-card">
                <h3>15</h3>
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
                <h3 class="section-title">📂 แผนการจัดการเรียนรู้ภาคปฏิบัติการรายสัปดาห์ (สัปดาห์ที่ 1 - 15)</h3>
                <div class="unit-grid-layout" style="display: flex; flex-direction: column; gap: 15px;">

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 1</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">ความรู้พื้นฐานระบบปฏิบัติการเครื่องแม่ข่าย</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> Client vs Server, ประเภทเซิร์ฟเวอร์, NOS, แนะนำ Linux & Ubuntu LTS, บทบาท SysAdmin<br><strong>ปฏิบัติ:</strong> ติดตั้ง VirtualBox, สร้าง VM และติดตั้ง Ubuntu Server 24.04 LTS</p>
                        </div>
                        <a href="unit1.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 2</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Linux Command Line และโครงสร้างระบบไฟล์</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> โครงสร้างระบบไฟล์ (FHS), สตรีมข้อมูล (stdin, stdout, stderr), Shell และ Bash คืออะไร<br><strong>ปฏิบัติ:</strong> ควบคุมระบบผ่านคำสั่ง CLI พื้นฐาน (pwd, ls, cd, mkdir, cp, mv, rm, cat, nano) และ Lab โฟลเดอร์องค์กร</p>
                        </div>
                        <a href="unit2.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 3</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">การจัดการผู้ใช้งานและสิทธิ์ (User & Permission)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> ระบบความปลอดภัย Linux, กลไกสิทธิ์ผู้ใช้ rwx, เลขฐานแปด (Octal Permission) และเจ้าของไฟล์ (Ownership)<br><strong>ปฏิบัติ:</strong> การใช้คำสั่ง useradd, passwd, groupadd, chmod, chown ในการจำลองระบบสิทธิ์พนักงานองค์กร</p>
                        </div>
                        <a href="unit3.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 4</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">การตั้งค่าเครือข่ายและการเชื่อมต่อระยะไกล (Network & SSH)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> IP Address, Subnet Mask, Gateway, DNS Resolver และมาตรฐานความปลอดภัยโปรโตคอล SSH<br><strong>ปฏิบัติ:</strong> ตั้งค่า Static IP ในเซิร์ฟเวอร์, ติดตั้ง OpenSSH Server, รีโมทผ่าน PuTTY/VS Code และทำ SSH Hardening</p>
                        </div>
                        <a href="unit4.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 5</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">การจัดการ Package และ Service (Daemon Control)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> คลังโปรแกรม Repository, การพึ่งพากันระหว่างซอฟต์แวร์ (Dependency), วงจรของบริการและ Daemon<br><strong>ปฏิบัติ:</strong> บริหารจัดการและแก้ปัญหา Service ด้วยเครื่องมือระเบียนคำสั่ง apt, systemctl และการสแกนระบบย่อยผ่าน journalctl</p>
                        </div>
                        <a href="unit5.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 6</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">Firewall และความปลอดภัยพื้นฐานประจำเครื่อง</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> แนวคิดกำแพงไฟป้องกันระบบ (Firewall Concept), การทำงานของพอร์ตเครือข่ายและโปรโตคอล, หลักความปลอดภัยขั้นต้น<br><strong>ปฏิบัติ:</strong> ตั้งค่าจัดการความปลอดภัยผ่านคำสั่ง ufw, ตรวจสอบพอร์ตเชื่อมต่อด้วย ss -tulnp และ Lab วิเคราะห์ความเสี่ยงพอร์ต</p>
                        </div>
                        <a href="unit6.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 7</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการโดเมนเนม (DNS Server Infrastructure)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> ลำดับชั้นระบบ DNS Architecture, การจัดการแผนผัง Zone File, ระเบียนบันทึกหลัก (A Record, CNAME, MX Record)<br><strong>ปฏิบัติ:</strong> ดาวน์โหลดและปรับแต่งแก้ไขตารางตั้งค่า Bind9 เพื่อจัดทำระบบชื่อโดเมนภายในเครือข่ายจำลององค์กร</p>
                        </div>
                        <a href="unit7.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 8</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการจัดสรรหมายเลขไอพีอัตโนมัติ (DHCP Server)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> วงจรการทำงานจัดส่งไอพีของโปรโตคอล DHCP, กระบวนการ DORA (Discover, Offer, Request, Acknowledge), ระยะเวลาเช่า Lease Time<br><strong>ปฏิบัติ:</strong> ติดตั้งและกำหนดขอบเขตแจกจ่ายผ่านโปรแกรม isc-dhcp-server พร้อมฝึกระบบผูกขาดไอพี (IP Reservation)</p>
                        </div>
                        <a href="unit8.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 9</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการเว็บเซิร์ฟเวอร์ (Web Server Infrastructure)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> สถาปัตยกรรมเว็บอินเทอร์เน็ต, รูปแบบการทำงานโปรโตคอล HTTP/HTTPS, กลไกให้บริการเว็บเสมือน (Virtual Host)<br><strong>ปฏิบัติ:</strong> ปล่อยตัวติดตั้งและจัดตั้งเซิร์ฟเวอร์ด้วย Nginx หรือ Apache, Deploy หน้าเว็บ และแกะบันทึกข้อผิดพลาดผ่าน Access Log</p>
                        </div>
                        <a href="unit9.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 10</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการเซิร์ฟเวอร์ระบบฐานข้อมูล (Database Server)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> ระบบบริหารจัดการฐานข้อมูลเชิงสัมพันธ์ (RDBMS), สถาปัตยกรรมติดต่อเซิร์ฟเวอร์ข้อมูล, หลักภาษา SQL เบื้องต้น<br><strong>ปฏิบัติ:</strong> จัดระบบความปลอดภัย MariaDB/MySQL, เขียนคำสั่งเพิ่มสิทธิ์โครงสร้างผู้ใช้ฐานข้อมูล และทดสอบทำระบบ Backup/Restore ด่วน</p>
                        </div>
                        <a href="unit10.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 11</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการจัดเก็บและแบ่งปันทรัพยากรข้อมูล (File Sharing Server)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> กลไกแชร์ระบบคลังข้อมูลในสำนักงาน, รูปแบบโปรโตคอลกลาง SMB/CIFS, หลักการทำงานพื้นฐานโครงสร้างแบบ NAS<br><strong>ปฏิบัติ:</strong> ขับเคลื่อนคลังแชร์ผ่านโปรแกรม Samba Server, ล็อกพาสเวิร์ดแบ่งสิทธิ์ และรับการเปิดรีโมทดึงจากเครื่อง Client Windows</p>
                        </div>
                        <a href="unit11.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 12</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการกรองเว็บไซต์และตรวจรับรองตัวตน (Proxy & AAA Server)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> นิยามของเซิร์ฟเวอร์ตัวกลาง Proxy, แนวคิดสถาปัตยกรรม AAA (Authentication, Authorization, Accounting)<br><strong>ปฏิบัติ:</strong> ล็อกการเข้าถึงเว็บปลายทางผ่าน Squid Proxy และติดตั้งทดสอบ FreeRADIUS ตรวจรหัสผู้ใช้งานเข้าข่ายอินเทอร์เน็ต</p>
                        </div>
                        <a href="unit12.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 13</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">บริการโครงสร้างสถาปัตยกรรมยุคใหม่ (Container & IoT Platform)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> ข้อแตกต่างระว่างสภาพแวดล้อมเสมือน Hypervisor vs Container, โครงสร้างวิศวกรรม Docker และระบบฐาน IoT Platform<br><strong>ปฏิบัติ:</strong> รันระบบควบคุมตู้คอนเทนเนอร์ด้วยคำสั่ง Docker และ Docker Compose พร้อมทำแล็บเปิดใช้งานแผงบอร์ด IoT Node-RED</p>
                        </div>
                        <a href="unit13.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#f1f5f9; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 14</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">งานระบบอัตโนมัติและความปลอดภัยกุญแจเข้ารหัส (Automation & SSL)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ทฤษฎี:</strong> ระบบตั้งโปรแกรมคำสั่งอัตโนมัติ (Bash Automation), ตัวตั้งตารางเวลา Cron Job, กลไกของใบรับรอง SSL/TLS และ PKI พื้นฐาน<br><strong>ปฏิบัติ:</strong> เขียน Script ตัวแปรช่วยทำการบีบอัดเก็บไฟล์สำรองอัตโนมัติ และทดลองปั๊มตราประทับออกใบรับรองประเภท SSL Self-Signed</p>
                        </div>
                        <a href="unit14.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px;">ดูบทเรียน ➔</a>
                    </div>

                    <div class="unit-card-horizontal" style="background:#fff; border:1px solid #e2e8f0; padding:20px; border-radius:10px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <span class="unit-badge" style="background:#0f172a; color:#fff; padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:700;">สัปดาห์ที่ 15</span>
                            <h4 style="margin:8px 0 5px 0; color:#0f172a;">โครงงานจำลองสถาปัตยกรรมองค์กรจริงและการนำเสนอ (Final Presentation)</h4>
                            <p style="font-size:0.85rem; color:#475569; margin:0;"><strong>ภาคปิดท้ายการเรียน:</strong> นักศึกษานำเสนอผลงานและทำการส่งมอบ "โครงงานสถาปัตยกรรมจำลองเซิร์ฟเวอร์องค์กรขนาดเล็ก" โดยเปิดรัน Service ทุกโครงสร้างในระบบ Ubuntu Server พร้อมผ่านด่านทดสอบภาคปฏิบัติหน้างาน</p>
                        </div>
                        <a href="final-project.php" class="btn-enter-unit" style="width:auto; white-space:nowrap; margin-left:20px; background-color:#10b981; border-color:#059669;">ส่งโครงงาน ➔</a>
                    </div>

                </div>
            </div>

            <div class="sidebar-column">
                <div class="course-sidebar">

                    <div class="right-sidebar-box pre-requisite" style="border-left: 4px solid #3b82f6;">
                        <h3>🖥️ สภาพแวดล้อมห้องแล็บขั้นต่ำ</h3>
                        <ul style="list-style: none; padding-left: 0; font-size: 0.9rem; line-height: 1.6;">
                            <li style="margin-bottom:8px;">📌 <strong>ฮาร์ดแวร์:</strong> Core i5/Ryzen 5 | RAM 8GB ขึ้นไป | SSD 256GB+</li>
                            <li style="margin-bottom:8px;">📌 <strong>ตัวจำลองระบบ:</strong> Oracle VirtualBox หรือ VMware Workstation</li>
                            <li style="margin-bottom:8px;">📌 <strong>ระบบปฏิบัติการ:</strong> Ubuntu Server 24.04 LTS เป็นระบบแม่ข่ายแกนหลัก</li>
                            <li style="margin-bottom:8px;">📌 <strong>เครื่องไคลเอนต์ทดสอบ:</strong> Windows 10/11 หรือ Ubuntu Desktop</li>
                            <li>📌 <strong>โปรแกรมควบคุมย่อย:</strong> PuTTY, VS Code SSH, Docker Engine, htop</li>
                        </ul>
                    </div>

                    <div class="right-sidebar-box">
                        <h3 class="section-title">📊 สัดส่วนการวัดผลสัมฤทธิ์รายวิชา</h3>
                        <p style="font-size:0.9rem; color:#475569; margin-bottom:15px;">การประเมินเพื่อวัดสมรรถนะผู้เรียนตามมาตรฐานสถาบันคุณวุฒิวิชาชีพ แบ่งสัดส่วนออกเป็นดังนี้:</p>

                        <table class="grading-table" style="width:100%; border-collapse:collapse; font-size:0.9rem;">
                            <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
                                <th style="padding:10px; text-align:left; color:#0f172a;">ส่วนประกอบการวัดผล</th>
                                <th style="padding:10px; text-align:right; color:#0f172a;">ร้อยละ</th>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">🛠️ 1. งานทดลองปฏิบัติการประจำวีค (Lab)</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">40%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">📝 2. ใบงานวิเคราะห์สรุป (Assignment)</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">10%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">✍️ 3. การทดสอบย่อยภาคทฤษฎี (Quiz)</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">10%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">💻 4. สอบเก็บคะแนนปฏิบัติการกลางภาค</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">15%</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px; color:#475569;">🚀 5. โครงงานสถาปัตยกรรมระบบองค์กรจำลอง</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#2563eb;">25%</td>
                            </tr>
                            <tr style="background:#f1f5f9;">
                                <td style="padding:10px; font-weight:bold; color:#0f172a;">คะแนนประเมินรวมทั้งสิ้น</td>
                                <td style="padding:10px; text-align:right; font-weight:bold; color:#0f172a;">100%</td>
                            </tr>
                        </table>

                        <div style="margin-top:20px; background:#fef3c7; border-left:4px solid #d97706; padding:12px; border-radius:4px; font-size:0.85rem; color:#78350f;">
                            💡 <strong>แนวทางเชิงวิชาชีพ:</strong> รายวิชานี้ขับเคลื่อนด้วยกลไก <em>Scenario-Based Learning</em> และฝึกทักษะการวิเคราะห์ปัญหาหน้างานจริง (System Troubleshooting) เพื่อสร้างแอดมินระบบที่มีทักษะตรงความต้องการจริงในภาคอุตสาหกรรม
                        </div>
                    </div>
                </div>

            </div>
        </div>

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
                            <td>ระบบปฏิบัติการเครื่องแม่ข่าย <br> (Network Operating System for Serve)</td>
                        </tr>
                        <tr>
                            <td><strong>รหัสวิชา:</strong></td>
                            <td>31901-2002 (โครงสร้างเวลาเรียน 1 - 4 - 3)</td>
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
                            <td>มาตรฐานอาชีพ สถาบันคุณวุฒิวิชาชีพ รหัส 40106 อาชีพช่างสนับสนุนด้านเทคนิค ระดับ 5</td>
                        </tr>
                    </table>

                    <div class="spec-section-box">
                        <h5>🎯 ผลลัพธ์การเรียนรู้ระดับรายวิชา (Course Learning Outcome)</h5>
                        <p>ติดตั้งและสนับสนุนด้านเทคนิค เพื่อการใช้งานคอมพิวเตอร์แม่ข่ายด้านระบบสารสนเทศและระบบเครือข่ายตามหลักการ ด้วยความละเอียดรอบคอบ รับผิดชอบ การสื่อสาร การคิดเชิงนวัตกรรมและการทำงานเป็นทีม</p>
                    </div>

                    <div class="spec-section-box">
                        <h5>🎯 จุดประสงค์รายวิชา </h5>
                        <div><strong>เพื่อให้:</strong> </div>
                        <ol>
                            <li>เข้าใจเกี่ยวกับการติดตั้ง การใช้งานระบบปฏิบัติการเครื่องแม่ข่ายและแพ็กเก็ต (Packet) ที่สนับสนุนการให้บริการในระบบเครือข่าย</li>
                            <li>มีทักษะในการติดตั้ง การใช้งานระบบปฏิบัติการเครื่องแม่ข่ายและแพ็กเก็ต (Packet) ที่สนับสนุนการให้บริการในระบบเครือข่าย</li>
                            <li>มีเจตคติและกิจนิสัยที่ดีในการปฏิบัติงานด้วยความละเอียดรอบคอม รับผิดชอบ การสื่อสาร การคิดเชิงนวัตกรรมและการทำงานเป็นทีม</li>
                            <li>มีความสามารถประยุกต์ใช้ระบบปฏิบัติการเครื่องแม่ข่ายและแพ็กเก็ต (Packet) เพื่อให้บริการในระบบเครือข่าย</li>
                        </ol>
                    </div>

                    <div class="spec-section-box">
                        <h5>🎯 สมรรถนะประจำรายวิชา (Course Competency)</h5>
                        <ol>
                            <li>ประมวลความรู้เกี่ยวกับการติดตั้ง การใช้งานระบบปฏิบัติการเครื่องแม่ข่ายและแพ็กเก็ต (Packet) ที่สนับสนุนการให้บริการในระบบเครือข่ายตามหลักการ</li>
                            <li>ติดตั้งระบบปฏิบัติการเครื่องแม่ข่ายและแพ็กเก็ต (Packet) ที่สนับสนุนการให้บริการในระบบเครือข่ายตามขั้นตอน</li>
                            <li>ใช้งานระบบปฏิบัติการเครื่องแม่ข่ายตรงตามวัตถุประสงค์</li>
                            <li>ประยุกต์ใช้ระบบปฏิบัติการเครื่องแม่ข่ายและเลือกใช้แพ็กเก็ต (Packet) เพื่อให้บริการในระบบเครือข่าย</li>
                        </ol>
                    </div>

                    <div class="spec-section-box">
                        <h5>📖 คำอธิบายรายวิชา (Course Description)</h5>
                        <p style="text-indent: 40px; text-align: justify; line-height: 1.7;">
                            ศึกษาและปฏิบัติเกี่ยวกับ ระบบปฏิบัติการบนเครื่องแม่ข่าย (Network Operating System) การติดตั้งระบบปฏิบัติการบนเครื่องแม่ข่าย การตั้งค่าพื้นฐานบนระบบปฏิบัติการเครื่องแม่ข่าย การจัดการเกี่ยวกับรายละเอียดของผู้ใช้งาน การกำหนดสิทธิ์ใช้งาน การกำหนดการทำงานของ Firewall เบื้องต้น การควบคุมเครื่องแม่ข่ายระยะไกลผ่านเครือข่าย การติดตั้งและบริหารจัดการโปรแกรมในการให้บริการในรูปแบบต่าง ๆ ในระบบเครือข่าย ได้แก่ บริการด้านโดเมนเนม (DNS Server) บริการด้านเว็บ (Web Server) บริการด้านฐานข้อมูล (Database Server) บริการด้านการจัดสรรหมายเลขไอพี (DHCP Server) บริการด้านการแบ่งปันข้อมูลและทรัพยากร (File and Resource Sharing Server) บริการด้านการเป็นตัวกลาง (Proxy Server) บริการตรวจสอบยืนยันตัวตน (AAA Server) บริการด้าน Container Platform บริการด้าน IoT Platform การเขียนคำสั่งสคริปต์ การสร้างการเชื่อมต่อที่ปลอดภัย (SSL Certificate) และการให้บริการด้านอื่น ๆ ที่จำเป็น ติดตั้งและสนับสนุนด้านเทคนิคการใช้งานคอมพิวเตอร์เครื่องแม่ข่าย ด้านเครือข่ายและด้านระบบสารสนเทศให้ใช้งานได้ตามความต้องการของผู้ใช้
                        </p>
                    </div>

                    <div class="spec-section-box">
                        <h5>💡 แนวคิดและปรัชญาหลักประจำรายวิชา (Core Philosophy)</h5>
                        <p style="text-align: justify; line-height: 1.6;">
                            รายวิชานี้ตั้งเป้าหมายเพื่อให้ผู้เรียนตระหนักว่า <strong>"Server Operating System คือโครงสร้างพื้นฐานหลักของระบบสารสนเทศทั้งหมด"</strong> นักศึกษาจะไม่ได้ฝึกฝนเพียงแค่การจดจำชุดคำสั่งหรือขั้นตอนแบบท่องจำ แต่จะถูกผลักดันให้เข้าใจลึกซึ้งถึงกระบวนการทำงานขององค์กร การเชื่อมโยงโครงข่ายบริการความสัมพันธ์ระหว่าง Network Services ต่าง ๆ ระบบการรักษาความปลอดภัยขั้นรากฐาน และพัฒนาศักยภาพในการเป็นผู้แก้วิกฤตเชิงระบบ (System Troubleshooting) ที่ดีในอนาคต
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

        <script src="../assets/js/script.js"></script>
</body>

</html>