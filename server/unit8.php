<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 8: บริการจัดสรรหมายเลขไอพีอัตโนมัติ (DHCP Server & IPAM)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght=300;400;600;700&display=swap" rel="stylesheet">
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 8 (สัปดาห์ที่ 8)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">บริการจัดสรรหมายเลขไอพีอัตโนมัติ (DHCP Server) และระบบบริหารคลังไอพี (phpIPAM)</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เจาะลึกโปรโตคอลแจกจ่ายคอนฟิกเครือข่ายอัตโนมัติ โครงสร้างคำสั่ง DORA กลไกควบคุม Lease Time จนถึงระบบบริหารจัดการไอพีระดับ Enterprise ด้วย Kea, Stork และ phpIPAM</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: สถาปัตยกรรมการแจกจ่ายไอพี และกลไก DORA</h3>

                    <h4>1. ความเป็นมาของ Dynamic Host Configuration Protocol (DHCP)</h4>
                    <p>ลองจินตนาการถึงองค์กรที่มีคอมพิวเตอร์และสมาร์ทโฟนเชื่อมต่อเครือข่าย 1,000 เครื่อง หากผู้ดูแลระบบต้องเดินไปกรอกหมายเลข IP Address, Subnet Mask, Gateway และ DNS Server ด้วยตนเองทีละเครื่อง (Static IP) จะก่อให้เกิดความล่าช้าและเกิดปัญหาหมายเลขไอพีชนกัน (IP Conflict) ได้ง่าย ระบบ <strong>DHCP (พอร์ตเครือข่าย UDP 67 สำหรับ Server และ UDP 68 สำหรับ Client)</strong> จึงถูกพัฒนามาเพื่อแก้ปัญหานี้โดยทำหน้าที่จัดส่งการตั้งค่าเครือข่ายทั้งหมดให้แก่เครื่องลูกข่ายโดยอัตโนมัติทันทีที่เสียบสายแลนหรือต่อ Wi-Fi</p>

                    <h4 style="margin-top: 25px;">2. ถอดรหัส 4 ขั้นตอนกระบวนการทำงานแบบ DORA</h4>
                    <p>เนื่องจากในตอนแรกเริ่ม เครื่องคอมพิวเตอร์ Client ยังไม่มีไอพีแอดเดรสและไม่รู้ว่าเครื่องไหนคือผู้แจกจ่าย มันจึงต้องใช้กลไกตะโกนคุยกระจายสัญญาณ (Broadcast) ผ่านสเต็ปที่เรียกว่า <strong>DORA Process</strong> ดังนี้:</p>

                    <div class="img-wrapper" style="margin: 20px 0; text-align: center;">

                        <div class="image-caption">แผนผังขั้นตอนการสื่อสารแบบ 4-Way Handshake ของโปรโตคอล DHCP (DORA Process)</div>
                    </div>

                    <div class="step-box" style="margin: 20px 0; background: #fdfdfd; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                            <li style="padding-bottom: 15px; border-bottom: 1px dashed #f1f5f9;">
                                <strong style="color: #ef4444; font-size: 1.1rem;">1. D - Discover (Client ➔ Server):</strong><br>
                                <span style="font-size: 0.95rem; color: #334155;">เครื่องลูกข่ายเปิดเครื่องขึ้นมาแล้วส่งแพ็กเก็ต Broadcast ตะโกนออกไปในวงแลนว่า <em>"มี DHCP Server คนไหนอยู่ในวงนี้บ้างไหม? ฉันต้องการไอพีแอดเดรส!"</em></span>
                            </li>
                            <li style="padding: 15px 0; border-bottom: 1px dashed #f1f5f9;">
                                <strong style="color: #f59e0b; font-size: 1.1rem;">2. O - Offer (Server ➔ Client):</strong><br>
                                <span style="font-size: 0.95rem; color: #334155;">เมื่อ DHCP Server ได้ยิน จะค้นหาไอพีที่ยังว่างอยู่ในคลังข้อมูล แล้วส่งแพ็กเก็ตตอบกลับเสนอตัวเลขไปให้ว่า <em>"ฉันอยู่นี่! ฉันขอเสนอหมายเลข 192.168.10.50 ให้คุณเอาไปใช้งาน"</em></span>
                            </li>
                            <li style="padding: 15px 0; border-bottom: 1px dashed #f1f5f9;">
                                <strong style="color: #3b82f6; font-size: 1.1rem;">3. R - Request (Client ➔ Server):</strong><br>
                                <span style="font-size: 0.95rem; color: #334155;">เครื่องลูกข่ายตอบรับกลับแบบ Broadcast เพื่อบอกให้เซิร์ฟเวอร์ตัวอื่นๆ (ถ้ามี) ทราบทั่วกันว่า <em>"ตกลง! ฉันขอเลือกรับไอพีหมายเลข 192.168.10.50 จากเซิร์ฟเวอร์เครื่องนี้แหละ"</em></span>
                            </li>
                            <li style="padding-top: 15px;">
                                <strong style="color: #10b981; font-size: 1.1rem;">4. A - Acknowledge (Server ➔ Client):</strong><br>
                                <span style="font-size: 0.95rem; color: #334155;">DHCP Server ส่งเอกสารยืนยันขั้นสุดท้าย ล็อกเบอร์ไอพีนี้ในตาราง และส่งพารามิเตอร์อื่นๆ (Gateway, DNS) ไปให้เครื่องลูกข่ายบันทึกร่างเริ่มเปิดสิทธิ์ใช้งานอินเทอร์เน็ต</span>
                            </li>
                        </ul>
                    </div>

                    <h4 style="margin-top: 25px;">3. ความเข้าใจเรื่องระยะเวลาเช่า (Lease Time) และตัวแปรคอนฟิก</h4>
                    <p>ไอพีแอดเดรสที่ถูกแจกจ่ายไปจะไม่ได้ติดตัวเครื่องลูกข่ายไปตลอดชีวิต แต่จะเป็นการ <strong>"เช่าใช้งาน"</strong> ตามระยะเวลาที่กำหนด เรียกว่า <strong>Lease Time</strong> เพื่อดึงเบอร์ไอพีกลับคืนสู่คลังวงกลางยามที่พนักงานคนนั้นปิดเครื่องหรือกลับบ้านไปแล้ว โดยมีพารามิเตอร์หลักดังนี้:</p>
                    <ul>
                        <li><code class="inline-code">default-lease-time</code> : ค่าเวลาเริ่มต้นสิทธิ์การเช่า (หน่วยเป็นวินาที) หากครบ 50% ของเวลา เครื่องลูกข่ายจะส่งคำขอต่ออายุอัตโนมัติ (DHCP Request Renewal)</li>
                        <li><code class="inline-code">max-lease-time</code> : เพดานสูงสุดที่อนุญาตให้ขยายสิทธิ์การเช่าได้ในกรณีที่มีการร้องขอพิเศษ</li>
                        <li><code class="inline-code">range</code> : ขอบเขตเลขไอพีเริ่มต้นและสิ้นสุด (Pool) ที่เปิดสิทธิ์คัดเลือกให้กลุ่มเครื่องทั่วไปหยิบไปรันใช้งาน</li>
                    </ul>

                    <h4 style="margin-top: 25px;">4. แนวคิดระบบบริหารจัดการหมายเลขไอพี IPAM (IP Address Management)</h4>
                    <p>ในขณะที่ DHCP ทำหน้าที่ <strong>"แจกจ่ายไอพีแบบชั่วคราวไดนามิก"</strong> แต่ในองค์กรยังมีอุปกรณ์ที่ใช้ไอพีแบบถาวร (Static IP) อีกมาก เช่น เซิร์ฟเวอร์, สวิตช์, เราเตอร์ และกล้องวงจรปิด ระบบ <strong>IPAM</strong> (เช่น phpIPAM) จึงถูกนำเข้ามาใช้เป็น <strong>"สมุดบัญชีกลางประจำบ้าน"</strong> เพื่อช่วยผู้ดูแลระบบตรวจสอบแผนผังภาพรวมเครือข่ายทั้งหมด ป้องกันการกรอกไอพีซ้ำซ้อน และสแกนหาเครื่องแปลกปลอมที่แอบเข้ามาพ่วงในระบบ</p>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ 1: การจัดการกลุ่ม Pool และผูกขาดไอพี (Text Mode)</h3>
                    <p>ผู้ดูแลระบบจะใช้แพ็คเกจดั้งเดิมยอดนิยมอย่าง <strong>isc-dhcp-server</strong> ในการสาธิตการตั้งค่าการจัดสิทธิ์ขอบเขตวงแลนภายในไฟล์ระบบข้อความ:</p>

                    <h4 style="margin-top: 15px;">ขั้นตอนที่ 1: การลงโครงสิทธิ์ขอบเขตสระไอพี (DHCP Subnet Scope)</h4>
                    <p>เปิดแก้ไขไฟล์พิกัดหลัก <code>sudo nano /etc/dhcp/dhcpd.conf</code> แล้วเขียนโครงสร้างสระข้อมูลลงไปท้ายไฟล์:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">dhcpd.conf</span></div>
                        <pre>subnet 192.168.10.0 netmask 255.255.255.0 {
    range 192.168.10.50 192.168.10.150;     # สระไอพีที่เปิดแจก (101 หมายเลข)
    option routers 192.168.10.1;            # ชี้ค่า Gateway ขององค์กร
    option domain-name-servers 8.8.8.8, 1.1.1.1; # ค่า DNS แจกจ่ายออกไป
    default-lease-time 600;                 # สิทธิ์เช่า 10 นาที (สำหรับวงแลนหมุนเวียนไว)
    max-lease-time 7200;                    # เช่าเต็มเพดานไม่เกิน 2 ชั่วโมง
}</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 2: ระบบผูกขาดล็อกไอพีถาวรประจำบุคคล (IP Reservation)</h4>
                    <p>ในกรณีที่บางเครื่องต้องการใช้ไอพีเดิมตลอดกาล เช่น เครื่องปริ้นเตอร์ส่วนกลาง หรือเครื่องผู้บริหาร แอดมินสามารถนำหมายเลขการ์ดเครือข่าย <strong>MAC Address</strong> มาผูกขาดล็อกเบอร์ตายตัวได้ดังนี้:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">dhcpd.conf (Reservation Block)</span></div>
                        <pre>host VIP-PRINTER {
    hardware ethernet 00:11:22:AA:BB:CC;   # หมายเลข MAC Address ของตัวเครื่องเป้าหมาย
    fixed-address 192.168.10.25;           # เลขไอพีล็อกเฉพาะเจาะจงที่จะแจกให้เครื่องนี้เท่านั้น
}</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 3: กำหนดพอร์ตอินเตอร์เฟสและสั่งเริ่มระบบ</h4>
                    <p>ระบุชื่อการ์ดเครือข่ายในไฟล์ <code>/etc/default/isc-dhcp-server</code> (เช่น INTERFACESv4="eth1") จากนั้นสั่งรันบริการ:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo dhcpd -t -cf /etc/dhcp/dhcpd.conf  # สั่งตรวจสอบความถูกต้องของโครงสร้างไฟล์
sudo systemctl restart isc-dhcp-server</pre>
                    </div>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">🚀 ภาคปฏิบัติ 2: สถาปัตยกรรม Enterprise ยุคใหม่ด้วย Kea DHCP และ ISC Stork</h3>
                    <p>ปัจจุบันสมาคม ISC ได้ประกาศหยุดพัฒนาซอฟต์แวร์คลาสสิกตัวเดิม และแนะนำให้เปลี่ยนมาใช้ <strong>Kea DHCP</strong> ซึ่งมีความเร็วสูง ปรับแต่งคอนฟิกผ่านรูปแบบไฟล์ <strong>JSON Structure</strong> และเก็บข้อมูลลง Database ได้โดยตรง โดยมอนิเตอร์ผ่าน <strong>ISC Stork Dashboard (Web-based GUI)</strong></p>

                    <h4>1. วิธีการจัดแต่งโครงสร้างไฟล์ของ Kea DHCP (Kea-DHCP4 JSON)</h4>
                    <p>ไฟล์คอนฟิกของ Kea จะอยู่ที่พิกัด <code>/etc/kea/kea-dhcp4.conf</code> โดยจะเปลี่ยนผ่านไปใช้รูปแบบโครงสร้างวงเล็บปีกกา JSON:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">kea-dhcp4.conf</span></div>
                        <pre>{
"Dhcp4": {
    "interfaces-config": { "interfaces": [ "eth1" ] },
    "valid-lifetime": 4000,
    "subnet4": [
        {
            "subnet": "192.168.20.0/24",
            "pools": [ { "pool": "192.168.20.100 - 192.168.20.200" } ],
            "option-data": [ { "name": "routers", "data": "192.168.20.1" } ],
            "reservations": [
                {
                    "hw-address": "00:aa:bb:cc:dd:ee",
                    "ip-address": "192.168.20.55"
                }
            ]
        }
    ]
}
}</pre>
                    </div>

                    <h4 style="margin-top: 25px;">2. การเชื่อมต่อควบคุมและดูระบบด้วย ISC Stork GUI</h4>
                    <p>ติดตั้งระบบคุมงานส่วนกลาง (Stork Server) และตัวแทนฝั่งลูกข่าย (Stork Agent) เพื่อทำการดึงสถิติของ Kea DHCP ขึ้นมาแสดงผลในรูปแบบกราฟ Visual Pool Monitoring บนหน้าเว็บเบราว์เซอร์ ช่วยให้แอดมินสามารถตรวจเช็กปริมาณไอพีที่เหลือรันอยู่ได้แบบเรียลไทม์ และเพิ่มสิทธิ์ล็อกเครื่องผ่านหน้าจอได้โดยไม่ต้องพิมพ์แก้ไขโค้ด</p>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">📊 ภาคปฏิบัติ 3: การจัดการคลังที่อยู่ไอพีขององค์กรด้วย phpIPAM (Docker Mode)</h3>
                    <p>เนื่องจาก <strong>phpIPAM</strong> ทำงานบนระบบ Web Server (LAMP Stack) เพื่อให้ห้องแลบสามารถดำเนินไปได้อย่างรวดเร็วโดยไม่ต้องเสียเวลากลุ่มตั้งค่าเว็บเซิร์ฟเวอร์แบบแมนนวล เราจะใช้เทคโนโลยี <strong>Docker Container</strong> ในการสั่งรันแอปพลิเคชันขึ้นมาอย่างรวดเร็ว:</p>

                    <h4 style="margin-top: 15px;">1. สั่งรัน phpIPAM ร่วมกับฐานข้อมูล MariaDB ด้วย Docker-Compose</h4>
                    <p>สร้างไฟล์ <code>docker-compose.yml</code> ขึ้นมาเพื่อสั่งเปิดตู้คอนเทนเนอร์บริการแบบเบ็ดเสร็จในตัว:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">docker-compose.yml</span></div>
                        <pre>version: '3'
services:
  phpipam-db:
    image: mariadb:latest
    environment:
      - MYSQL_ROOT_PASSWORD=my_root_password
      - MYSQL_DATABASE=phpipam
      - MYSQL_USER=phpipam
      - MYSQL_PASSWORD=phpipam_password
    volumes:
      - phpipam-db-data:/var/lib/mysql

  phpipam-web:
    image: phpipam/phpipam-web:latest
    ports:
      - "8080:80"
    environment:
      - IPAM_DATABASE_HOST=phpipam-db
      - IPAM_DATABASE_USER=phpipam
      - IPAM_DATABASE_PASS=phpipam_password
      - IPAM_DATABASE_NAME=phpipam
    depends_on:
      - phpipam-db

volumes:
  phpipam-db-data:</pre>
                    </div>

                    <div class="code-window" style="margin-top: 10px;">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo docker-compose up -d   # สั่งเปิดระบบให้ทำงานเบื้องหลังอัตโนมัติ</pre>
                    </div>

                    <h4 style="margin-top: 25px;">2. กระบวนการเข้าใช้งานแลบระบบควบคุม IPAM GUI:</h4>
                    <ul style="padding-left: 20px;">
                        <li><strong>การเข้าสู่ระบบครั้งแรก:</strong> เปิดเบราว์เซอร์ไปที่ <code>http://[IP-Server]:8080</code> กดติดตั้ง Database อัตโนมัติ ล็อกอินด้วยผู้ใช้ <strong>admin</strong> และรหัสผ่าน <strong>ipamadmin</strong></li>
                        <li><strong>สร้าง Subnet แผนผังองค์กร:</strong> ไปที่เมนู <strong>Subnets</strong> ➔ คลิกเลือกโฟลเดอร์เครือข่ายหลัก ➔ กดปุ่ม <strong>Add Subnet</strong> เพื่อประกาศวงสิทธิ์เครือข่าย เช่น <code>192.168.10.0/24</code></li>
                        <li><strong>สั่งสแกนตรวจสอบอุปกรณ์ (ICMP Scan):</strong> ดำเนินการกดปุ่มสัญลักษณ์แว่นขยาย (Scan Subnet for alive hosts) ระบบ phpIPAM จะส่งสัญญาณ Ping แฝงไปตรวจสอบคอมพิวเตอร์ในวงแลนจริง หากเจอเครื่องเปิดอยู่จะบันทึกสถานะลงทะเบียนขึ้นตาราง Dashboard ให้โดยอัตโนมัติ</li>
                    </ul>
                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 8<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> โครงสร้างผังจำลองเขียนค่าวิเคราะห์ DORA ถูกต้อง (3 คะแนน) ใบแลบการจองค่า Fixed Address (3 คะแนน) ผลแลบคลังจัดการไอพีบนระบบ phpIPAM สำเร็จ (4 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #ef4444;">
                    <h4>🚨 กับดักอันตราย: ภัยพิบัติจาก Rogue DHCP Server</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        ความพังพินาศอันดับต้นๆ ในวงการเน็ตเวิร์กเกิดจากกรณีที่นักศึกษาทำแลบนี้เสร็จแล้วแอบเปิดบริการตัวนี้ทิ้งไว้ หรือมีพนักงานนำเราเตอร์ส่วนตัวมาแอบเสียบพ่วงในตึก ทำให้เครื่องเซิร์ฟเวอร์เถื่อนตัวนั้นส่งสเต็ป <strong>DHCP Offer</strong> แข่งตัดหน้าเซิร์ฟเวอร์หลักขององค์กร ส่งผลให้ผู้ใช้ทั่วไปได้รับเบอร์ไอพีมั่ว วงแลนล่ม และอินเทอร์เน็ตขาดการเชื่อมต่อทันที แอดมินจึงต้องปิดบริการทุกครั้งหลังจบคลาสแลบครับ!
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>