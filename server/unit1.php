<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "server"; // เปิดสถานะเมนูที่วิชา Server Linux
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 1: ความรู้พื้นฐานระบบปฏิบัติการเครื่องแม่ข่ายและการติดตั้ง | 31901-2002</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <span class="course-code" style="color: var(--accent); font-weight: bold; font-size: 0.9rem;">📚 หน่วยที่ 1 | สัปดาห์ที่ 1 (5 ชั่วโมง)</span>
            <h2 style="margin-top: 5px;">ความรู้พื้นฐานระบบปฏิบัติการเครื่องแม่ข่ายและการติดตั้ง</h2>
            <p style="color: #94a3b8; margin-top: 5px;">ปูพื้นฐานสถาปัตยกรรม Client-Server, ระบบปฏิบัติการเครือข่าย (NOS) และการติดตั้ง Ubuntu Server 24.04 LTS</p>
        </div>
    </div>

    <div class="container" style="margin-top: 25px; margin-bottom: 5px;">
        <a href="index.php" class="back-link">⬅️ ย้อนกลับสู่หน้าหลักวิชา ระบบปฏิบัติการเครื่องแม่ข่าย</a>
    </div>

    <div class="container">
        <div class="main-content-layout" style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 30px; margin-bottom: 5px;">

            <div class="content-column">

                <div class="theory-section-wrapper" style="background: var(--white); padding: 30px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
                    <h3 style="color: var(--secondary); border-bottom: 2px solid #2563eb; padding-bottom: 8px; margin-bottom: 20px;">📘 สรุปสาระสำคัญภาคทฤษฎี (Theoretical Foundation)</h3>

                    <div class="sub-topic" style="margin-bottom: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 8px;">1. นิยามของ Server และสถาปัตยกรรม Client-Server</h4>
                        <p style="text-indent: 30px; text-align: justify; font-size: 0.95rem; color: #334155;">
                            <strong>Server (เครื่องแม่ข่าย)</strong> คือ ระบบคอมพิวเตอร์หรือโปรแกรมคอมพิวเตอร์ที่ทำหน้าที่คอยตอบรับคำขอ เปิดพื้นที่จัดเก็บ ปฏิบัติการประมวลผล และให้บริการทรัพยากร (Resources) ข้อมูล (Data) หรือบริการเฉพาะทาง (Services) แก่เครื่องคอมพิวเตอร์เครื่องอื่นผ่านทางระบบเครือข่าย ซึ่งคอมพิวเตอร์ที่ส่งคำขอเข้ามาใช้บริการเหล่านั้นจะเรียกว่า <strong>Client (เครื่องลูกข่าย)</strong>
                        </p>
                        <p style="text-indent: 30px; text-align: justify; font-size: 0.95rem; color: #334155; margin-top: 8px;">
                            โครงสร้างแบบ <strong>Client-Server Architecture</strong> ถือเป็นโมเดลการกระจายศูนย์ประมวลผล โดยทำงานเป็นวงจรคือ Client ส่งคำขอร้อง (Request) ผ่านช่องทางโปรโตคอลเครือข่าย -> Server คอยดักฟังพอร์ต (Listening) และประมวลผลสิทธิ์คำขอ -> Server จัดการส่งข้อมูลผลลัพธ์ตอบกลับ (Response) ไปยัง Client
                        </p>
                    </div>

                    <div class="sub-topic" style="margin-bottom: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 8px;">2. ประเภทของ Server ในระบบสารสนเทศองค์กร</h4>
                        <p style="font-size: 0.95rem; color: #334155; margin-bottom: 8px;">ในการทำงานจริงในปัจจุบัน เซิร์ฟเวอร์จะถูกแบ่งแยกบทบาทหน้าที่ตามแอปพลิเคชันหรือแพ็กเกจที่ติดตั้งลงไป ดังนี้:</p>
                        <ul style="padding-left: 20px; font-size: 0.95rem; color: #334155;">
                            <li><strong>Web Server:</strong> ทำหน้าที่จัดเก็บหน้าเว็บและส่งมอบเนื้อหา (HTML, CSS, JS, รูปภาพ) ผ่านโปรโตคอล HTTP/HTTPS เช่น Nginx, Apache</li>
                            <li><strong>Database Server:</strong> ทำหน้าที่บริหารจัดการคลังเก็บข้อมูลเชิงสัมพันธ์ มีระบบความปลอดภัยและการค้นคืนที่มีประสิทธิภาพ เช่น MySQL, MariaDB, PostgreSQL</li>
                            <li><strong>File Server:</strong> คลังจัดเก็บข้อมูลส่วนกลางเพื่อแบ่งปันไฟล์เอกสารภายในองค์กรผ่านโปรโตคอลเครือข่าย เช่น Samba, NFS, NAS</li>
                            <li><strong>Infrastructure Services (DNS & DHCP):</strong> DNS ทำหน้าที่แปลงชื่อโดเมนเป็นหมายเลข IP ส่วน DHCP ทำหน้าที่บริหารจัดการและแจกจ่าย IP ให้แก่เครื่องไคลเอนต์โดยอัตโนมัติ</li>
                        </ul>
                    </div>

                    <div class="sub-topic" style="margin-bottom: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 8px;">3. ระบบปฏิบัติการเครือข่าย (Network Operating System - NOS)</h4>
                        <p style="text-indent: 30px; text-align: justify; font-size: 0.95rem; color: #334155;">
                            ต่างจากระบบปฏิบัติการทั่วไป (Desktop OS) อย่าง Windows 11 หรือ macOS ที่มุ่งเน้นความสวยงามของ GUI และความสะดวกสบายของผู้ใช้รายบุคคล แต่ <strong>NOS (Network Operating System)</strong> ถูกสร้างขึ้นมาเพื่อขับเคลื่อนงานที่ต้องการความเสถียรสูงสุด (High Availability) สามารถเปิดทำงานได้ตลอด 24 ชั่วโมงโดยไม่ต้องรีบูต รองรับการเชื่อมต่อจากผู้ใช้พร้อมกันจำนวนมาก มีสถาปัตยกรรมความปลอดภัยที่เข้มงวด และตัดส่วนกราฟิกที่ไม่จำเป็นออกไปเพื่อนำทรัพยากร CPU และ RAM ทั้งหมดไปประมวลผลงานบริการเครือข่าย
                        </p>
                    </div>

                    <div class="sub-topic" style="margin-bottom: 20px;">
                        <h4 style="color: var(--primary); margin-bottom: 8px;">4. รู้จักกับ Linux Distribution และค่าย Ubuntu Server LTS</h4>
                        <p style="text-indent: 30px; text-align: justify; font-size: 0.95rem; color: #334155;">
                            เนื่องจากแกนหลัก Linux Kernel เป็นโอเพนซอร์ส (Open-source) บริษัทหรือกลุ่มผู้พัฒนาต่างๆ จึงนำไปปรับแต่งและแจกจ่ายในชื่อค่ายของตนเอง เรียกว่า <strong>Linux Distribution (Distro)</strong> เช่น Red Hat (RHEL), Debian, AlmaLinux และ Ubuntu
                        </p>
                        <p style="text-indent: 30px; text-align: justify; font-size: 0.95rem; color: #334155; margin-top: 8px;">
                            วิชานี้ใช้ <strong>Ubuntu Server 24.04 LTS (Noble Numbat)</strong> เป็นแกนหลักของการศึกษา คำว่า <strong>LTS ย่อมาจาก Long-Term Support</strong> ซึ่งเป็นเวอร์ชันที่ Canonical ออกรหัสมาเพื่อเน้นเสถียรภาพสำหรับใช้ในภาคธุรกิจองค์กร โดยจะมีการปล่อยรุ่นใหม่ทุกๆ 2 ปี (ในปีก่อนคริสต์ศักราชที่เป็นเลขคู่) และการันตีการอัปเดตแพตช์ความปลอดภัยและแก้บั๊กยาวนานถึง 5 ปีเต็ม (และขยายได้ถึง 10 ปีผ่าน Ubuntu Pro) จึงทำให้เป็นตัวเลือกอันดับหนึ่งของระบบคลาวด์และเซิร์ฟเวอร์ทั่วโลก
                        </p>
                    </div>

                    <div class="sub-topic">
                        <h4 style="color: var(--primary); margin-bottom: 8px;">5. บทบาทหน้างานของ System Administrator (SysAdmin)</h4>
                        <p style="font-size: 0.95rem; color: #334155;">หน้าที่หลักของวิศวกรระบบหรือผู้ดูแลเครื่องแม่ข่าย มีดังนี้:</p>
                        <ul style="padding-left: 20px; font-size: 0.95rem; color: #334155;">
                            <li>⚙️ <strong>Provisioning:</strong> วางแผน จัดหา ติดตั้ง และตั้งค่าระบบปฏิบัติการคอมพิวเตอร์แม่ข่ายให้พร้อมใช้งาน</li>
                            <li>🛡️ <strong>Security Hardening:</strong> อัปเดตแพตช์ระบบความปลอดภัย ปิดช่องโหว่ ตั้งค่าไฟร์วอลล์ และจำกัดสิทธิ์ผู้ใช้</li>
                            <li>📈 <strong>Monitoring:</strong> ตรวจสอบสถานะการทำงาน (Resource Utilization) เช่น อัตราการใช้ CPU, RAM, Storage และการรับส่งข้อมูล</li>
                            <li>🛠️ <strong>Troubleshooting:</strong> อ่านบันทึกเหตุการณ์ของระบบ (Log Files) เพื่อวิเคราะห์ วิเคราะห์ และแก้ไขปัญหาเมื่อบริการเครือข่ายหยุดทำงาน</li>
                        </ul>
                    </div>
                </div>

                <div class="lab-section-wrapper" style="background: var(--white); padding: 30px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
                    <h3 style="color: var(--secondary); border-bottom: 2px solid #10b981; padding-bottom: 8px; margin-bottom: 20px;">🛠️ คู่มือปฏิบัติการรายสัปดาห์ (Step-by-Step Lab Guide)</h3>

                    <div class="lab-step" style="margin-bottom: 18px; border-left: 3px solid #10b981; padding-left: 15px;">
                        <h5 style="font-size: 1rem; color: var(--secondary); margin-bottom: 5px;">ขั้นตอนที่ 1: เตรียม Hypervisor สภาพแวดล้อมเสมือน</h5>
                        <p style="font-size: 0.9rem; color: #475569;">ดาวน์โหลดและติดตั้งโปรแกรม <strong>Oracle VirtualBox</strong> ลงบนเครื่องคอมพิวเตอร์ Host ของนักศึกษา (ตรวจสอบให้แน่ใจว่าได้เข้าไปเปิดฟังก์ชัน Virtualization Technology เช่น Intel VT-x หรือ AMD-V ใน BIOS ของเครื่องคอมพิวเตอร์เรียบร้อยแล้ว)</p>
                    </div>

                    <div class="lab-step" style="margin-bottom: 18px; border-left: 3px solid #10b981; padding-left: 15px;">
                        <h5 style="font-size: 1rem; color: var(--secondary); margin-bottom: 5px;">ขั้นตอนที่ 2: ดาวน์โหลดและสร้าง Virtual Machine</h5>
                        <ul style="font-size: 0.9rem; color: #475569; padding-left: 20px;">
                            <li>ไปที่เว็บไซต์อย่างเป็นทางการของ Ubuntu เพื่อดาวน์โหลดไฟล์อิมเมจ <strong>Ubuntu Server 24.04 LTS (ISO Image)</strong></li>
                            <li>เปิด VirtualBox คลิก <strong>New</strong> เพื่อสร้าง VM ใหม่ ตั้งชื่อว่า <code>Ubuntu-Server-NOS</code></li>
                            <li>จัดสรรหน่วยความจำ <strong>RAM อย่างน้อย 2048 MB (2GB)</strong> และหน่วยประมวลผล <strong>CPU 2 Cores</strong> ขึ้นไป</li>
                            <li>สร้างฮาร์ดดิสก์เสมือน (Virtual Hard Disk) ชนิด VDI ขนาด <strong>อย่างน้อย 25 GB</strong> (เลือกแบบ Dynamically allocated)</li>
                        </ul>
                    </div>

                    <div class="lab-step" style="margin-bottom: 18px; border-left: 3px solid #10b981; padding-left: 15px;">
                        <h5 style="font-size: 1rem; color: var(--secondary); margin-bottom: 5px;">ขั้นตอนที่ 3: ความเข้าใจและการตั้งค่า Network Mode (สำคัญมาก!)</h5>
                        <p style="font-size: 0.9rem; color: #475569; margin-bottom: 5px;">ก่อนเริ่มเปิดเครื่อง VM ให้นักศึกษาคลิกขวาที่ชื่อ VM ไปที่ <strong>Settings -> Network</strong> และทำความเข้าใจความต่างของโหมดต่อไปนี้:</p>
                        <table style="width:100%; border-collapse:collapse; font-size:0.85rem; margin-bottom:10px;">
                            <tr style="background:#f8fafc; border-bottom:1px solid #cbd5e1;">
                                <th style="padding:6px; text-align:left;">โหมดเครือข่าย</th>
                                <th style="padding:6px; text-align:left;">ลักษณะการทำงาน</th>
                                <th style="padding:6px; text-align:left;">ข้อดี / ข้อเสีย สำหรับงานแล็บ</th>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:6px; font-weight:bold; color:#1d4ed8;">NAT Mode</td>
                                <td style="padding:6px;">VM ได้รับไอพีแจกภายในจาก VirtualBox (มักเป็น 10.0.2.x) โดยแชร์เน็ตจากเครื่อง Host ออกภายนอก</td>
                                <td style="padding:6px; color:#b45309;">ออกอินเทอร์เน็ตเพื่อโหลดโปรแกรมได้ทันที แต่เครื่อง Host หรืออุปกรณ์ภายนอกจะไม่สามารถรีโมทเข้ามาหาเซิร์ฟเวอร์ตรงๆ ได้</td>
                            </tr>
                            <tr>
                                <td style="padding:6px; font-weight:bold; color:#10b981;">Bridged Adapter</td>
                                <td style="padding:6px;">VM จำลองตัวเองต่อเข้ากับเราเตอร์ LAN/Wi-Fi จริงของห้องปฏิบัติการ ได้ไอพีวงเดียวกับเครื่อง Host</td>
                                <td style="padding:6px; color:#15803d;">เครื่อง Host และอุปกรณ์ในแล็บสามารถยิงสแกน พอร์ต และรีโมท SSH เข้าหาเครื่อง VM ได้โดยตรงเสมือนเครื่องเซิร์ฟเวอร์จริงในองค์กร</td>
                            </tr>
                        </table>
                        <p style="font-size: 0.85rem; color: #ef4444;">🚨 <strong>ข้อแนะนำในห้องเรียน:</strong> สำหรับสัปดาห์ที่ 1 ให้เลือกใช้ <strong>NAT</strong> หรือ <strong>Bridged Adapter</strong> (ตามข้อกำหนดเครือข่ายของแผนกวิชาเพื่อไม่ให้ไอพีชนกันบนเครือข่ายวิทยาลัย)</p>
                    </div>

                    <div class="lab-step" style="margin-bottom: 18px; border-left: 3px solid #10b981; padding-left: 15px;">
                        <h5 style="font-size: 1rem; color: var(--secondary); margin-bottom: 5px;">ขั้นตอนที่ 4: ลำดับหน้าต่างตัวติดตั้ง Ubuntu Server 24.04 LTS</h5>
                        <p style="font-size: 0.9rem; color: #475569; margin-bottom: 5px;">กด Start เครื่อง VM และดำเนินตามขั้นตอนตารางติดตั้งบนหน้าจอข้อความย่อย (CLI Installer) ดังนี้:</p>
                        <ol style="font-size: 0.9rem; color: #475569; padding-left: 20px; line-height: 1.6;">
                            <li><strong>Language:</strong> เลือก <code>English</code> (เป็นมาตรฐานหน้างาน เนื่องจากภาษาไทยอาจแสดงผลเป็นฟอนต์กล่องสี่เหลี่ยมอ่านไม่ออกบนหน้าจอ Command Line Interface)</li>
                            <li><strong>Keyboard Configuration:</strong> เลือก Layout และ Variant เป็น <code>English (US)</code></li>
                            <li><strong>Choose Type of Install:</strong> เลือก <code>Ubuntu Server</code> แบบปกติ (หากเลือกแบบ minimized ระบบจะตัดเครื่องมือเน็ตเวิร์กพื้นฐานออกไปซึ่งไม่เหมาะกับการเริ่มต้นศึกษา)</li>
                            <li><strong>Network Connections:</strong> ระบบจะทำการตรวจสอบและดึง IP ผ่านกลไก DHCP อัตโนมัติ (ให้บันทึกหรือถ่ายรูปค่าไอพีนี้ไว้)</li>
                            <li><strong>Configure Proxy / Archive Mirror:</strong> ใช้ค่าเริ่มต้น ระบบจะชี้เป้าไปที่คลังกระจายซอฟต์แวร์ที่ใกล้ที่สุดเพื่อให้ดาวน์โหลดแพ็กเกจได้รวดเร็ว</li>
                            <li><strong>Storage Configuration:</strong> เลือก <code>Use an entire disk</code> และแนะนำให้กากบาทติ๊กถูกที่ช่อง <code>Set up this disk as an LVM group</code> (Logical Volume Manager ช่วยให้เราบริหารจัดการขยายขนาดพื้นที่ฮาร์ดดิสก์เสมือนได้ยืดหยุ่นในอนาคต) จากนั้นกด Done เพื่อยินยอมเขียนทับโครงสร้างดิสก์</li>
                            <li><strong>Profile Setup:</strong> กรอกข้อมูลผู้ใช้งานส่วนตัวลงไป:
                                <ul style="padding-left: 15px; list-style-type: circle;">
                                    <li><em>Your name:</em> ชื่อตัวตนของนักศึกษา (ภาษาอังกฤษ)</li>
                                    <li><em>Your server's name:</em> ชื่อโฮสต์เครื่องแม่ข่าย เช่น <code>nos-server01</code></li>
                                    <li><em>Pick a username:</em> บัญชีผู้ใช้ที่ใช้ล็อกอิน (**ห้ามใช้ชื่อ root** เนื่องจากระบบ Ubuntu จะปิดกั้นสิทธิ์การตั้งชื่อ root โดยตรงเพื่อความปลอดภัย)</li>
                                    <li><em>Choose a password:</em> รหัสผ่านระบบความปลอดภัยที่นักศึกษาต้องจดจำให้แม่นยำ</li>
                                </ul>
                            </li>
                            <li><strong>SSH Setup:</strong> <span style="color:#ef4444; font-weight:bold;">🚨 ขั้นตอนสำคัญที่สุดประจำสัปดาห์!</span> ให้เลื่อนเคอร์เซอร์ลงมาแล้วกดปุ่ม Spacebar เพื่อทำเครื่องหมายกากบาทเลือกช่อง <code>[X] Install OpenSSH server</code> (หากข้ามขั้นตอนนี้ไป นักศึกษาจะไม่สามารถใช้โปรแกรมภายนอกรีโมทเข้ามาควบคุมเครื่องได้ในสัปดาห์ถัดไป)</li>
                            <li><strong>Featured Server Snaps:</strong> หน้านี้คือแพ็กเกจสำเร็จรูปของระบบคลาวด์ ในสัปดาห์แรกนี้ให้เลื่อนลงไปกด Done ข้ามไปก่อน เนื่องจากเราจะทำการติดตั้งและคอมฟิกบริการต่างๆ ด้วยมือเองทีละหน่วยเรียนรู้</li>
                            <li><strong>Installation Progress & Reboot:</strong> ระบบจะติดตั้งระบบแกนหลักลงฮาร์ดดิสก์ รอจนกระทั่งข้อความด้านบนสุดเปลี่ยนจาก Installing เป็น <code>Install complete!</code> ให้เลือกหัวข้อ <code>Reboot Now</code> แล้วกด Enter เพื่อเริ่มต้นระบบใหม่</li>
                        </ol>
                    </div>

                    <div class="lab-step" style="border-left: 3px solid #10b981; padding-left: 15px;">
                        <h5 style="font-size: 1rem; color: var(--secondary); margin-bottom: 5px;">ขั้นตอนที่ 5: การล็อกอินเข้าสู่ระบบครั้งแรก (First Boot Login)</h5>
                        <p style="font-size: 0.9rem; color: #475569;">เมื่อเซิร์ฟเวอร์เปิดขึ้นมาเสร็จสิ้น หน้าจอจะหยุดลงตรงคำว่า <code>login:</code> ให้กรอก Username ที่ตั้งไว้แล้วกด Enter ตามด้วยรหัสผ่าน (ระหว่างพิมพ์รหัสผ่าน หน้าจอจะ*ไม่มี*ตัวอักษรหรือเครื่องหมายดอกจันแสดงขึ้นมาเพื่อความปลอดภัยด้านความลับ ให้พิมพ์ต่อไปจนครบแล้วกด Enter) หากสำเร็จจะเข้าสู่หน้า Bash Shell พร้อมใช้งาน</p>
                    </div>
                </div>

                <div class="serverworld-resource-box" style="background: #f0fdf4; border: 2px dashed #10b981; padding: 25px; border-radius: 8px;">
                    <h4 style="color: #166534; display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                        🌐 แหล่งข้อมูลศึกษาเพิ่มเติมระดับสากล (External Documentation)
                    </h4>
                    <p style="font-size: 0.95rem; color: #14532d; line-height: 1.6; text-align: justify; margin-bottom: 15px;">
                        สำหรับการศึกษาหาความรู้ขั้นสูงเพิ่มเติมและตรวจสอบรูปแบบคำสั่งที่เป็นมาตรฐานอุตสาหกรรม นักศึกษาสามารถเข้าไปศึกษาคู่มือการตั้งค่าอย่างละเอียดได้ที่คลังข้อมูลวิศวกรรมระบบของ <strong>Ubuntu 24.04 Configuration Tutorials : Server World</strong> ซึ่งเป็นเว็บไซต์คู่มือแอดมินระบบที่ได้รับการยอมรับและอ้างอิงทั่วโลก
                    </p>

                    <div style="background: var(--white); border: 1px solid #cbd5e1; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                        <h5 style="color: var(--secondary); margin-bottom: 8px; font-size: 0.9rem; font-weight: 700;">📌 หัวข้อแนะนำสำหรับบทเรียนสัปดาห์ที่ 1 บน Server World:</h5>
                        <ul style="font-size: 0.88rem; color: #334155; padding-left: 20px; line-height: 1.6;">
                            <li><strong>Ubuntu 24.04 : Initial Settings :</strong> ข้อมูลแสดงขั้นตอนหลังการติดตั้งระบบปฏิบัติการเสร็จสิ้น</li>
                            <li><strong>Ubuntu 24.04 : Add User Accounts :</strong> วิธีการเพิ่มและจัดการโครงสร้างสิทธิ์บัญชีผู้ใช้ระดับรากฐาน</li>
                            <li><strong>Ubuntu 24.04 : Network Settings :</strong> ภาพรวมแนวทางการตรวจสอบอินเทอร์เฟซและการกำหนดสถาปัตยกรรมเน็ตเวิร์ก</li>
                        </ul>
                    </div>

                    <div style="text-align: right;">
                        <a href="https://www.server-world.info/en/note?os=Ubuntu_24.04" target="_blank" rel="noopener noreferrer" style="display: inline-block; background: #166534; color: var(--white); text-decoration: none; padding: 10px 18px; border-radius: 5px; font-size: 0.9rem; font-weight: bold; transition: background 0.2s;">
                            เปิดไปยังเว็บไซต์ Server World (Ubuntu 24.04) ➔
                        </a>
                    </div>
                </div>

            </div>

            <div class="sidebar-column">
                <div class="course-sidebar">

                    <div class="right-sidebar-box" style="background: var(--white); border-top: 4px solid #2563eb; margin-bottom: 20px; padding: 20px; border-radius: 8px; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0;">
                        <h3 style="font-size: 1.1rem; color: var(--secondary); margin-bottom: 12px;">📝 ใบงานและการส่งงาน (Assignment)</h3>
                        <p style="font-size: 0.88rem; color: #475569; margin-bottom: 10px; font-weight: bold; color: var(--primary);">หัวข้อ: ใบงานปฏิบัติการที่ 1.1 การจัดตั้งเครื่องเซิร์ฟเวอร์เสมือน</p>
                        <p style="font-size: 0.85rem; color: #475569; line-height: 1.5; margin-bottom: 12px;">ให้นักศึกษาจัดทำรายงานผลการทดลองปฏิบัติการในรูปแบบไฟล์ PDF โดยต้องมีข้อมูลรูปภาพหลักฐานสำคัญดังต่อไปนี้:</p>
                        <ul style="font-size: 0.85rem; color: #334155; padding-left: 15px; margin-bottom: 15px; line-height: 1.6;">
                            <li>📸 ภาพถ่ายขั้นตอนการจัดตั้งสเปก RAM, CPU และพื้นที่ดิสก์บนโปรแกรม VirtualBox</li>
                            <li>📸 ภาพหลักฐานหน้าจอหน้าต่างติดตั้งขณะเปิดใช้งานกลไก <code>[X] OpenSSH Server</code></li>
                            <li>📸 ภาพถ่ายการพิมพ์คำสั่งล็อกอินเข้าหน้าจอ CLI สำเร็จพร้อมแสดงข้อความต้อนรับของ Ubuntu 24.04 LTS</li>
                            <li>✍️ เขียนบทวิเคราะห์ความแตกต่างและขอบเขตสิทธิ์ความปลอดภัยระหว่างโหมดเชื่อมต่อเครือข่าย NAT และ Bridged Adapter ตามความเข้าใจลงในรายงาน</li>
                        </ul>
                        <span style="display: block; font-size: 0.8rem; background: #fee2e2; color: #991b1b; padding: 6px; border-radius: 4px; text-align: center; font-weight: bold;">🚨 กำหนดส่งงาน: ก่อนการเรียนในสัปดาห์ถัดไป</span>
                    </div>

                    <div class="right-sidebar-box" style="background: var(--white); border-top: 4px solid #10b981; padding: 20px; border-radius: 8px; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0;">
                        <h3 style="font-size: 1.1rem; color: var(--secondary); margin-bottom: 12px;">🎯 ตัวชี้วัดความสำเร็จประจำสัปดาห์</h3>
                        <p style="font-size: 0.85rem; color: #475569; margin-bottom: 10px;">หลังเสร็จสิ้นกระบวนการจัดการเรียนรู้ในสัปดาห์นี้ นักศึกษาจะต้องมีทักษะความรู้ตามเกณฑ์ดังนี้:</p>
                        <ul style="list-style: none; padding-left: 0; font-size: 0.85rem; line-height: 1.7;">
                            <li style="margin-bottom: 6px;">✔️ 1. สามารถอธิบายความต่างของเครื่องแม่ข่ายและลูกข่ายได้ถูกต้อง</li>
                            <li style="margin-bottom: 6px;">✔️ 2. ทราบเหตุผลความจำเป็นในการเลือกใช้งานระบบปฏิบัติการรุ่น LTS</li>
                            <li style="margin-bottom: 6px;">✔️ 3. มีความเข้าใจข้อดีและข้อจำกัดของโหมดการจำลอง Network แต่ละประเภท</li>
                            <li>✔️ 4. สามารถดำเนินการติดตั้งระบบ Ubuntu Server 24.04 ลงบนสภาพแวดล้อมเสมือนได้ด้วยตัวเองและล็อกอินระบบผ่าน CLI ได้</li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>