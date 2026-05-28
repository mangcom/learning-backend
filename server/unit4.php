<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 4: การตั้งค่าเครือข่ายและการเชื่อมต่อระยะไกล (Network & SSH)</title>
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 4 (สัปดาห์ที่ 4)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">การตั้งค่าเครือข่ายและการเชื่อมต่อระยะไกล</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เจาะลึกโครงสร้างพื้นฐานเครือข่ายสำหรับเซิร์ฟเวอร์ การตั้งค่า IP แบบคงที่ผ่าน Netplan และการเพิ่มความปลอดภัยขั้นสูงให้โปรโตคอล SSH</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: โครงสร้างเครือข่ายและระบบความปลอดภัย SSH</h3>

                    <h4>1. องค์ประกอบพื้นฐานของระบบเครือข่ายเซิร์ฟเวอร์ (Network Fundamentals)</h4>
                    <p>เครื่องเซิร์ฟเวอร์ที่ทำหน้าที่ให้บริการ จำเป็นต้องระบุตำแหน่งและเส้นทางการเดินทางของข้อมูลอย่างแม่นยำ แตกต่างจากเครื่องคอมพิวเตอร์ทั่วไปที่ใช้การสุ่มไอพีอัตโนมัติ (DHCP) โดยมี 4 แกนหลักที่ต้องเข้าใจดังนี้:</p>

                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px; width: 25%;">หัวข้อองค์ประกอบ</th>
                                <th style="padding: 10px;">คำอธิบายและหน้าที่เชิงลึก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>IP Address</strong></td>
                                <td>หมายเลขที่ระบุตัวตนของเซิร์ฟเวอร์ในระบบเครือข่าย (เช่น 192.168.10.50) ประกอบไปด้วย Network ID และ Host ID</td>
                            </tr>
                            <tr>
                                <td><strong>Subnet Mask</strong></td>
                                <td>ตัวกำหนดขอบเขตและขนาดของเน็ตเวิร์ก (เช่น 255.255.255.0 หรือเขียนย่อแบบ CIDR ว่า /24) ช่วยแยกแยะว่าไอพีใดอยู่ในวงเดียวกันหรือต่างวง</td>
                            </tr>
                            <tr>
                                <td><strong>Gateway</strong></td>
                                <td>ประตูทางผ่านออกสู่นอกวงเครือข่าย (ปกติคือไอพีของตัว Router เช่น 192.168.10.1) หากไม่มีค่านี้ เซิร์ฟเวอร์จะไม่สามารถออกสู่อินเทอร์เน็ตได้</td>
                            </tr>
                            <tr>
                                <td><strong>DNS Resolver</strong></td>
                                <td>ระบบแปลชื่อโดเมนเนมเป็นหมายเลขไอพี (เช่น แปลกูเกิลคอมเป็นไอพี) นิยมใช้ของสาธารณะที่มีความเสถียร เช่น <code>8.8.8.8</code> (Google) หรือ <code>1.1.1.1</code> (Cloudflare)</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4 style="margin-top: 25px;">2. โปรโตคอล SSH (Secure Shell) คืออะไร?</h4>
                    <p>ในอดีตการควบคุมเซิร์ฟเวอร์ระยะไกลจะใช้โปรโตคอล <strong>Telnet (พอร์ต 23)</strong> ซึ่งไม่มีการเข้ารหัสข้อมูล ทำให้ผู้ไม่หวังดีสามารถดักจับรหัสผ่านกลางทางได้ (Clear Text) จึงได้มีการพัฒนาโปรโตคอล <strong>SSH (พอร์ต 22)</strong> ขึ้นมาทดแทน โดยทำการเข้ารหัสข้อมูลตั้งแต่ต้นทางถึงปลายทางด้วยสถาปัตยกรรม Asymmetric Encryption (คีย์คู่สาธารณะและคีย์ส่วนตัว)</p>

                    <h4 style="margin-top: 25px;">3. แนวคิดการทำ SSH Hardening (การปรับปรุงความปลอดภัยขั้นสูง)</h4>
                    <p>พอร์ต 22 ของโปรโตคอล SSH มักเป็นเป้าหมายแรกที่ถูกแฮกเกอร์โจมตีด้วยวิธีสุ่มรหัสผ่าน (Brute Force Attack) การทำ Hardening จึงเป็นการปิดช่องโหว่พื้นฐานของเซิร์ฟเวอร์โดย:</p>
                    <ul>
                        <li><strong>การเปลี่ยนพอร์ตมาตรฐาน:</strong> ย้ายจากพอร์ต 22 ไปเป็นพอร์ตส่วนตัวที่เดายาก (เช่น พอร์ตช่วง 1024-65535)</li>
                        <li><strong>การสั่งห้ามบัญชี Root เข้าถึงระยะไกล:</strong> บังคับให้ล็อกอินด้วยยูสเซอร์ธรรมดาก่อน แล้วค่อยใช้คำสั่ง <code>sudo su</code> เพื่อเพิ่มสิทธิ์ เพื่อความปลอดภัยสองชั้น</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ: การตั้งค่า Netplan และเครื่องมือรีโมท</h3>

                    <h4>ระบบ Netplan บน Ubuntu Server</h4>
                    <p>ตั้งแต่เวอร์ชัน 18.04 เป็นต้นมา Ubuntu ได้เปลี่ยนมาใช้เครื่องมือที่ชื่อว่า <strong>Netplan</strong> ในการควบคุมการตั้งค่าการ์ดจอเครือข่าย โดยจะเขียนคำสั่งควบคุมในรูปแบบไฟล์ภาษา <strong>YAML (.yaml)</strong> ซึ่งเก็บไว้ที่โฟลเดอร์ <code>/etc/netplan/</code></p>

                    <div class="analogy-box" style="background: #fffbeb; border-left: 4px solid #d97706;">
                        <strong>⚠️ ข้อควรระวังขั้นวิกฤตสำหรับการเขียน YAML ใน Netplan:</strong>
                        <p style="margin: 5px 0 0 0;">ภาษา YAML <strong>ไม่อนุญาตให้ใช้ปุ่ม Tab</strong> ในการเคาะเว้นวรรคเด็ดขาด ให้ใช้การเคาะ <strong>Spacebar (เว้นวรรค) ทีละ 2 หรือ 4 ครั้ง</strong> เพื่อจัดตำแหน่งย่อหน้าให้ตรงกันตามลำดับโครงสร้างชั้นข้อมูล หากเว้นวรรคเยื้องไม่ตรงกัน ระบบจะแจ้งข้อผิดพลาดรุนแรงและเน็ตเวิร์กจะพังทันที</p>
                    </div>

                    <h4 style="margin-top: 25px;">เครื่องมือสำหรับการเชื่อมต่อระยะไกล (Remote Clients)</h4>
                    <ul>
                        <li><strong>PuTTY:</strong> โปรแกรมดั้งเดิมขนาดเล็กยอดนิยมสำหรับเปิดหน้าจอ Terminal ฝั่ง Windows</li>
                        <li><strong>VS Code (Remote - SSH Extension):</strong> เครื่องมือสมัยใหม่ที่ช่วยให้ผู้พัฒนาสามารถแก้ไขโค้ด คุมระบบ และจัดการไฟล์บนเซิร์ฟเวอร์ได้อย่างสะดวกผ่านหน้าต่างจัดการของ VS Code โดยตรง</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🧪 Hands-on Lab: การตั้งค่า Static IP และ SSH Hardening</h3>
                    <div class="assignment-box">
                        <strong>🎯 สถานการณ์จำลอง:</strong> ปรับปรุงเครื่องเซิร์ฟเวอร์ให้เป็นไอพีคงที่เลขหมาย <code>192.168.10.150/24</code> พร้อมติดตั้งระบบเชื่อมต่อระยะไกล และทำการล็อกไม่ให้ Root เข้าถึงตรงๆ พร้อมทั้งย้ายพอร์ตควบคุมหลักไปที่หมายเลข <code>2222</code>
                    </div>

                    <h4 style="margin-top: 20px;">ขั้นตอนที่ 1: ตรวจสอบชื่อการ์ดเครือข่ายและแก้ไข Netplan</h4>
                    <p>สั่งพิมพ์คำสั่งค้นหาชื่อการ์ดแลนในเครื่อง (เช่น มักขึ้นต้นด้วย <code>enp0s3</code> หรือ <code>eth0</code>)</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>ip a</pre>
                    </div>
                    <p style="margin-top: 10px;">เปิดเข้าไฟล์ตั้งค่าเครือข่ายของระบบ (ชื่อไฟล์ด้านหลังสุดอาจแตกต่างกันไปตามเวอร์ชันเครื่อง):</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo nano /etc/netplan/00-installer-config.yaml</pre>
                    </div>
                    <p style="margin-top: 10px;">ทำการลบเนื้อหาเดิมออก และปรับปรุงโครงสร้างตามรูปแบบด้านล่างนี้อย่างละเอียด (ระวังเรื่องการเคาะ Spacebar):</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">YAML Config</span></div>
                        <pre>network:
  version: 2
  renderer: networkd
  ethernets:
    enp0s3:
      dhcp4: no
      addresses:
        - 192.168.10.150/24
      routes:
        - to: default
          via: 192.168.10.1
      nameservers:
        addresses: [8.8.8.8, 1.1.1.1]</pre>
                    </div>
                    <p style="margin-top: 10px;">สั่งตรวจสอบโครงสร้างและบันทึกเปิดใช้งานการตั้งค่าใหม่ไปยังการ์ดแลน:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo netplan try
sudo netplan apply</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 2: ติดตั้ง OpenSSH Server และเปิดใช้งาน</h4>
                    <p>ดาวน์โหลดตัวชุดบริการโปรแกรมแม่ข่ายสำหรับการควบคุมระยะไกลเข้าสู่ระบบเซิร์ฟเวอร์:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo apt update
sudo apt install openssh-server -y
sudo systemctl status ssh</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 3: กระบวนการทำ SSH Hardening (ย้ายพอร์ตและบล็อก Root)</h4>
                    <p>เข้าไปแก้ไขโครงสร้างความปลอดภัยหลักของระบบบริการ SSH:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo nano /etc/ssh/sshd_config</pre>
                    </div>
                    <p style="margin-top: 10px;">ทำการเลื่อนหาบรรทัดเป้าหมาย และแก้ไขข้อความโดยลบเครื่องหมายคอมเมนต์ (#) ด้านหน้าออก:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">sshd_config แก้ไขจุดสำคัญ</span></div>
                        <pre>Port 2222                      # 👈 ปรับเปลี่ยนจากเลข 22 เดิมเป็น 2222
PermitRootLogin no             # 👈 ปรับเปลี่ยนจากเดิมที่เป็น yes/prohibit-password ให้เป็น no</pre>
                    </div>
                    <p style="margin-top: 10px;">สั่งเริ่มระบบควบคุมบริการใหม่เพื่อให้โครงสร้างความปลอดภัยเริ่มทำงานทันที:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo systemctl restart sshd
sudo systemctl restart ssh</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 4: การทดสอบเชื่อมต่อจากเครื่องภายนอก</h4>
                    <p>เปิดโปรแกรม PuTTY หรือ Terminal บนคอมพิวเตอร์ส่วนตัวของผู้เรียน แล้วทดสอบล็อกอินด้วยเงื่อนไขใหม่:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Client Remote Command</span></div>
                        <pre>ssh username@192.168.10.150 -p 2222</pre>
                    </div>
                    <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;">⚠️ <em>ทดลองทดสอบใช้สิทธิ์ <code>root</code> รีโมทเข้าตรงๆ ระบบต้องแจ้งปฏิเสธการเชื่อมต่อ (Access Denied) จึงจะถือว่าผ่านเกณฑ์ความปลอดภัยสูงสุดของใบงาน</em></p>
                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 4<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> คะแนนทดสอบเชื่อมต่อด้วยพอร์ตพิเศษผ่าน (5 คะแนน) สรุปความเข้าใจ YAML (5 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #f59e0b;">
                    <h4>🚨 ข้อห้ามระวังหลังเปลี่ยน Port</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        หากเซิร์ฟเวอร์เปิดใช้งานระบบไฟร์วอลล์ (เช่น UFW) อยู่ อาจารย์ต้องเตือนให้นักศึกษาพิมพ์คำสั่ง <code>sudo ufw allow 2222/tcp</code> เพื่อเปิดพอร์ตใหม่เสียก่อนจะกดปิดหน้าต่าง Terminal เดิม มิเช่นนั้นเซิร์ฟเวอร์จะตัดขาดจากเครือข่ายและไม่มีผู้ใดสามารถรีโมทเข้าไปแก้ไขระบบได้อีกเลย
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>