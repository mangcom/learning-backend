<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 7: บริการโดเมนเนม (DNS Server Infrastructure)</title>
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 7 (สัปดาห์ที่ 7)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">บริการโดเมนเนม (DNS Server Infrastructure)</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">ถอดรหัสกลไกการแปลงชื่อระบบอินเทอร์เน็ต เจาะลึกการคอนฟิกไฟล์ Bind9 เรียนรู้ทางเลือกยุคใหม่ด้วย Technitium DNS และไกด์ไลน์สู่การจดทะเบียนโดเมนระดับสากล</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: สถาปัตยกรรมโครงสร้างต้นไม้และขั้นตอนการทำงานของ DNS</h3>

                    <h4>1. ลำดับชั้นระบบ DNS Architecture (Hierarchical Name Space)</h4>
                    <p>เนื่องจากบนโลกนี้มีเว็บไซต์มหาศาล ระบบ DNS จึงไม่สามารถเก็บข้อมูลทุกอย่างไว้ในคอมพิวเตอร์เครื่องเดียวได้ จึงออกแบบให้จัดเก็บแบบกระจายศูนย์ (Distributed Database) เรียงลำดับลงมาเป็นโครงสร้างต้นไม้กลับหัว:</p>

                    <ul style="padding-left: 20px; margin-bottom: 20px;">
                        <li><strong>Root Domain (.):</strong> จุดสูงสุดของลำดับชั้น (แฝงอยู่ท้ายสุดของโดเมนเสมอแต่เราไม่ต้องพิมพ์) บริหารโดยรูทเซิร์ฟเวอร์หลัก 13 ชุดทั่วโลก คอยชี้ทางไปหา TLD</li>
                        <li><strong>Top-Level Domain (TLD):</strong> กลุ่มรหัสท้ายสุดของชื่อโดเมน แบ่งเป็น <em>gTLD</em> (เช่น .com, .net, .org) และ <em>ccTLD</em> ซึ่งเป็นโดเมนประจำประเทศ (เช่น .th, .jp, .uk)</li>
                        <li><strong>Second-Level Domain:</strong> ชื่อแบรนด์หรือชื่อองค์กรที่ผู้ใช้อย่างเราขอลงทะเบียนจดสิทธิ์ครอบครอง (เช่น google, chula, company)</li>
                        <li><strong>Subdomain:</strong> ชื่อเครื่องหรือบริการย่อยที่แอดมินองค์กรสร้างเพิ่มขึ้นมาเองได้อย่างอิสระ (เช่น www, mail, api, backend)</li>
                    </ul>

                    <h4>2. ขั้นตอนการทำงานของระบบ DNS (DNS Resolution Process)</h4>
                    <p>เมื่อผู้ใช้งานเรียกเข้าหน้าเว็บไซต์ผ่านทางเบราว์เซอร์ ระบบเครือข่ายจะมีกลไกกระบวนการสืบค้นข้อมูลแบบย้อนกลับขึ้นไปตามลำดับชั้น (Recursive Query) เพื่อแกะรอยหาหมายเลขไอพีที่แท้จริง โดยมีขั้นตอนการทำงานทั้งหมด 9 ลำดับดังนี้:</p>

                    <div class="img-wrapper">
                        <img src="assets/images/how-to-dns-work.jpg" alt="DNS Recursive Query Input Process" class="responsive-img">
                        <div class="image-caption">แผนผังจำลองขั้นตอนกระบวนการทำสืบค้นสิทธิ์ชื่อโดเมน (DNS Recursive Query) สู่ปลายทางเว็บเซิร์ฟเวอร์</div>
                    </div>

                    <div class="step-box" style="margin-top: 20px; background-color: #fdfdfd;">
                        <ol style="padding-left: 20px; font-size: 0.95rem; line-height: 1.7;">
                            <li style="margin-bottom: 8px;"><strong>User requests:</strong> ผู้ใช้งานพิมพ์ชื่อโดเมน <code class="inline-code">www.bncc.ac.th</code> บนเว็บเบราว์เซอร์ เครื่องคอมพิวเตอร์จะส่งคำถามไปถามตัวกระจายสัญญาณส่วนท้องถิ่นหรือ <strong>Local DNS Resolver</strong> (เช่น ตัวเซิร์ฟเวอร์ของ ISP หรือเราเตอร์ภายในตึก)</li>
                            <li style="margin-bottom: 8px;"><strong>Resolver queries Root:</strong> ในกรณีที่ Local DNS Resolver ไม่มีข้อมูลเก็บไว้ในหน่วยความจำสำรอง (Cache Check) มันจะทำหน้าที่วิ่งไปยื่นคำถามถามเซิร์ฟเวอร์จุดสูงสุดของโลก หรือ <strong>Root Name Servers</strong></li>
                            <li style="margin-bottom: 8px;"><strong>Root responds:</strong> Root Name Server จะตรวจสอบนามสกุลส่วนท้าย แล้วส่งข้อมูลตอบกลับมาเป็นรายชื่อกลุ่มเครื่องที่มีหน้าที่ดูแลนามสกุลประเทศนั้นๆ นั่นคือ <strong>TLD Name Servers (.th)</strong></li>
                            <li style="margin-bottom: 8px;"><strong>Resolver queries TLD:</strong> Local DNS Resolver รับข้อมูลมาแล้ว จึงส่งคำถามต่อไปยังเครื่องบริการ <strong>TLD Name Server (.th)</strong> ทันที</li>
                            <li style="margin-bottom: 8px;"><strong>TLD responds:</strong> เครื่อง TLD Name Server (.th) ค้นหาประวัติแล้วตอบกลับพร้อมส่งสิทธิ์ชี้พิกัดไปยังเซิร์ฟเวอร์ผู้ถือแผนผังตัวจริงตัวสุดท้าย หรือ <strong>Authoritative Name Server</strong> ที่รับผิดชอบโดเมน <code class="inline-code">bncc.ac.th</code></li>
                            <li style="margin-bottom: 8px;"><strong>Resolver queries authoritative server:</strong> Local DNS Resolver เดินหน้าส่งคำถามไปถามเครื่อง <strong>Authoritative Name Server</strong> ของ <code class="inline-code">bncc.ac.th</code> โดยตรง</li>
                            <li style="margin-bottom: 8px;"><strong>Authoritative returns A Record:</strong> เครื่อง Authoritative Name Server ค้นเจอระเบียนแผนผังภายในโซน แล้วส่งคำตอบกลับมาเป็นข้อความ <strong>A Record</strong> เพื่อระบุหมายเลขพิกัดไอพีแอดเดรสปลายทางคือ <code class="inline-code">110.78.30.114</code></li>
                            <li style="margin-bottom: 8px;"><strong>Resolver returns IP:</strong> ตัว Local DNS Resolver นำหมายเลขไอพี <code class="inline-code">110.78.30.114</code> ที่ได้ ส่งมอบคืนกลับไปให้แก่โปรแกรมเว็บเบราว์เซอร์ของผู้ใช้ พร้อมทำการเซฟเก็บเข้าฐานข้อมูล Cache ของตนเองเพื่อความรวดเร็วในการถามซ้ำครั้งต่อไป</li>
                            <li style="margin-bottom: 8px;"><strong>Successfully connected:</strong> โปรแกรมเว็บเบราว์เซอร์รับทราบพิกัดตัวเลข จึงทำการส่งแพ็กเก็ตข้อมูลวิ่งตรงไปเปิดการเชื่อมต่อเชื่อมโยงกับเครื่อง <strong>BNCC Web Server</strong> ตัวจริงเพื่อดึงข้อมูลหน้าเว็บมาแสดงผลบนจอภาพเป็นอันเสร็จสิ้นภารกิจ</li>
                        </ol>
                    </div>

                    <h4 style="margin-top: 25px;">3. ระเบียนบันทึกหลัก (Core Resource Records) ที่แอดมินต้องรู้</h4>
                    <p>ภายในตารางแผนผังการแปลงชื่อ (Zone File) จะบรรทัดข้อมูลประเภทต่างๆ ทำหน้าที่เฉพาะทางในการจับคู่ผลลัพธ์:</p>
                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px; width: 20%; text-align: center;">ประเภท Record</th>
                                <th style="padding: 10px; width: 30%;">ชื่อเต็มกลไก</th>
                                <th style="padding: 10px;">หน้าที่การทำงานหลัก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><strong>A Record</strong></td>
                                <td>Address Record</td>
                                <td>ทำหน้าที่แปลงจาก "ชื่อโฮสต์" ไปเป็น "หมายเลข IPv4" (เช่น www -> 192.168.10.10)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><strong>CNAME</strong></td>
                                <td>Canonical Name</td>
                                <td>สร้างชื่อเล่น (Alias) เพื่อชี้พุ่งไปหาอีกชื่อหนึ่ง (เช่น web -> ชี้ไปหา www.company.local)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><strong>MX Record</strong></td>
                                <td>Mail Exchanger</td>
                                <td>ระบุพิกัดไอพีหรือชื่อเครื่องของ "เซิร์ฟเวอร์รับส่งอีเมล" ประจำโดเมน (มีค่า Priority คอยจัดลำดับความสำคัญ)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><strong>NS Record</strong></td>
                                <td>Name Server</td>
                                <td>บอกว่าเซิร์ฟเวอร์เครื่องใดทำหน้าที่เป็นผู้ถือแผนผังคำตอบตัวจริง (Authoritative Server) ของโดเมนนี้</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ 1: การลงมือคอนฟิก BIND9 แบบดั้งเดิม (Text-Based)</h3>
                    <p><strong>BIND9 (Berkeley Internet Name Domain)</strong> คือซอฟต์แวร์ DNS Server ที่เป็นมาตรฐานและเก่าแก่ที่สุดบนระบบปฏิบัติการลินุกซ์</p>

                    <h4 style="margin-top: 15px;">ขั้นตอนที่ 1: ประกาศชื่อโซนในไฟล์หลัก</h4>
                    <p>เปิดไฟล์ <code>/etc/bind/named.conf.local</code> เพื่อบอก Bind9 ว่าเราจะรับผิดชอบดูแลชื่อโดเมนองค์กรภายในชื่อ <code>company.local</code></p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">named.conf.local</span></div>
                        <pre>zone "company.local" {
    type master;
    file "/etc/bind/db.company.local";
};</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 2: เขียนผังข้อมูล Zone File ตัวจริง</h4>
                    <p>สร้างไฟล์ขึ้นมาใหม่ตามพาทที่ระบุไว้ <code>sudo nano /etc/bind/db.company.local</code> และลงรายละเอียดระเบียบ Record:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">db.company.local</span></div>
                        <pre>$TTL    604800
@       IN      SOA     ns1.company.local. admin.company.local. (
                              2         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns1.company.local.
ns1     IN      A       192.168.10.10
www     IN      A       192.168.10.100
mail    IN      A       192.168.10.200
web     IN      CNAME   www
company.local. IN MX 10 mail.company.local.</pre>
                    </div>

                    <h4 style="margin-top: 25px;">ขั้นตอนที่ 3: ทดสอบและสั่งรันระบบ</h4>
                    <p>พิมพ์คำสั่งตรวจสอบไวยากรณ์ว่าเขียนผิดหรือไม่ หากไม่มีข้อความฟ้องเออร์เรอร์ ให้สั่งรีสตาร์ทบริการทันที:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo named-checkzone company.local /etc/bind/db.company.local
sudo systemctl restart bind9</pre>
                    </div>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">🌐 ภาคปฏิบัติ 2: ทางเลือกยุคใหม่ด้วย Technitium DNS (Web GUI)</h3>
                    <p>สำหรับวิศวกรระบบยุคใหม่ <strong>Technitium DNS</strong> ถือเป็นโซลูชันระดับ Open-source ยอดนิยมที่ถูกหยิบยกขึ้นมาเป็นพระเอก (ตามบันทึกของ Technitium Blog) เนื่องจากเปิดโอกาสให้แอดมินสามารถบริหารจัดการตั้งค่า DNS, ทำบล็อกโฆษณา (Ad Blocker) และดูสถิติกราฟความปลอดภัยได้ผ่านหน้าต่างอินเตอร์เฟส Web GUI ที่สวยงามโดยไม่ต้องเปิดพิมพ์โค้ดไฟล์ข้อความ</p>

                    <h4 style="margin-top: 20px;">1. วิธีสั่งติดตั้งด่วนผ่านสคริปต์อัตโนมัติบน Ubuntu:</h4>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>curl -sSL https://technitium.com/dns/install.sh | sudo bash</pre>
                    </div>

                    <h4 style="margin-top: 25px;">2. ขั้นตอนการเข้าใช้งานและบริหารจัดการผ่าน GUI:</h4>
                    <ul style="padding-left: 20px;">
                        <li><strong>การเข้าสู่ระบบ:</strong> เปิดเว็บเบราว์เซอร์ไปที่พิกัดไอพีเซิร์ฟเวอร์ตามด้วย <strong>Port 5380</strong> (เช่น <code>http://192.168.10.10:5380</code>) พร้อมกำหนดรหัสผ่านแอดมินในครั้งแรก</li>
                        <li><strong>การสร้างโซนโดเมน:</strong> คลิกไปที่เมนูแท็บ <strong>Zones</strong> ➔ กดปุ่ม <strong>Add Zone</strong> ➔ พิมพ์ชื่อชื่อโดเมนที่ต้องการลงไป เช่น <code>office.local</code></li>
                        <li><strong>การเพิ่ม Record:</strong> เมื่อกดเข้าไปในชื่อโซน จะเจอปุ่มสว่างสดใสให้กด <strong>Add Record</strong> แอดมินสามารถเลือกประเภทในดรอปดาวน์เมนูได้ทันที (A, CNAME, MX) กรอกข้อมูลในช่องกล่องข้อความแล้วกดบันทึก ระบบจะปรับตารางและอัปเดตกระจายสัญญาณให้พอร์ต 53 ทันทีโดยไม่ต้องกดรีสตาร์ทบริการเหมือน Bind9</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🏢 คู่มือสู่โลกความจริง: ขั้นตอนการจดทะเบียนหรือซื้อโดเมนเนมใช้งานจริง</h3>
                    <p>ชื่อนามสกุลลงท้ายระบบปิด `.local` หรือ `.test` ใช้รันได้เฉพาะห้องแลบฝึกฝน หากต้องการเปิดธุรกิจบริการสู่สายตาประชากรโลก ต้องผ่านขั้นตอนการจดทะเบียนอย่างถูกต้องตามกฎหมายไอที:</p>

                    <h4 style="margin-top: 20px;">📌 รูปแบบที่ 1: การจดโดเมนสากลทั่วไป (.com / .net / .org)</h4>
                    <p>เป็นการจดทะเบียนเสรี ใครๆ ก็สามารถเป็นเจ้าของได้ผ่านผู้ให้บริการระดับ Registrar ทั่วไป (เช่น Namecheap, GoDaddy, Hostinger, หรือผู้ให้บริการโฮสติ้งไทย)</p>
                    <div class="step-box">
                        <strong>🛠️ 4 ขั้นตอนกระบวนการจดเสรี:</strong>
                        <ol style="margin-top: 5px; padding-left: 20px;">
                            <li><strong>Check Availability:</strong> เข้าหน้าเว็บผู้ให้บริการ พิมพ์ค้นหาชื่อที่ต้องการเพื่อตรวจสอบว่าติดสิทธิ์มีคนอื่นซื้อไปแล้วหรือยัง</li>
                            <li><strong>Enter WHOIS Information:</strong> กรอกข้อมูลชื่อ-ที่อยู่ และอีเมลที่ติดต่อได้จริงของผู้ถือครองสิทธิ์ (เพื่อบันทึกลงฐานข้อมูลกลาง ICANN)</li>
                            <li><strong>Payment:</strong> ชำระค่าธรรมเนียมรักษาสิทธิ์ (เฉลี่ยประมาณ 350 - 600 บาทต่อปี ขึ้นอยู่กับค่าเงินและส่วนลด)</li>
                            <li><strong>Assign Nameservers (NS):</strong> จุดสำคัญที่สุด! เมื่อได้สิทธิ์ครอบครองแล้ว ให้เข้าไปที่แดชบอร์ด แล้วแก้ไขค่า <strong>Nameservers</strong> ให้ชี้มาที่หมายเลขไอพีเครื่องเซิร์ฟเวอร์ของเรา หรือชี้ไปที่ Cloudflare เพื่อเริ่มเปิดใช้งานผังการแปลงชื่อจริง</li>
                        </ol>
                    </div>

                    <h4 style="margin-top: 25px;">📌 รูปแบบที่ 2: การจดโดเมนเฉพาะประเทศของไทย (.th / .co.th / .ac.th)</h4>
                    <p>บริหารจัดสรรดูแลโดยหน่วยงาน <strong>THNIC (มูลนิธิศูนย์สารสนเทศเครือข่ายไทย)</strong> โดเมนประเภทนี้มีความน่าเชื่อถือสูงมากเนื่องจาก <em>"ไม่สามารถสุ่มสี่สุ่มห้าจดได้"</em> ต้องยื่นหลักฐานทางกฎหมายรองรับตามสิทธิ์เงื่อนไขที่เข้มงวด:</p>

                    <ul style="list-style-type: square; padding-left: 20px; margin-bottom: 15px;">
                        <li><strong>.co.th (Commercial):</strong> สำหรับนิติบุคคล/บริษัท ห้ามจดชื่อมั่ว ต้องเป็นชื่อที่พ้องหรือตรงกับ <strong>"หนังสือรับรองการจดทะเบียนบริษัท (พค.0401)"</strong> หรือเครื่องหมายการค้าเท่านั้น</li>
                        <li><strong>.ac.th (Academic):</strong> สำหรับสถาบันการศึกษา ต้องแนบ <strong>"หนังสือจัดตั้งโรงเรียน/วิทยาลัย"</strong> ที่ออกโดยกระทรวงศึกษาธิการ</li>
                        <li><strong>.in.th (Individual/Company):</strong> สำหรับบุคคลทั่วไปหรือองค์กร ใช้เพียงสำเนาบัตรประชาชนในการจดสิทธิ์</li>
                    </ul>

                    <div class="step-box" style="border-left: 4px solid #10b981;">
                        <strong>🛠️ ขั้นตอนการยื่นจดกับ THNIC หรือตัวแทน (เช่น THNIC Registrar):</strong>
                        <p style="margin: 5px 0 0 0; font-size: 0.9rem; line-height: 1.5;">
                            สมัครสมาชิกเปิดบัญชีผู้ใช้ ➔ เลือกชื่อโดเมน ➔ <strong>อัปโหลดไฟล์เอกสารทางกฎหมายข้างต้นเข้าสู่ระบบ</strong> ➔ เจ้าหน้าที่มนุษย์ของ THNIC จะทำการตรวจสอบความถูกต้องภายใน 1-2 วันทำการ ➔ เมื่อได้รับการอนุมัติจึงจะได้รับลิงก์ชำระเงิน และเปิดให้เข้าตั้งค่าจัดแจงตารางพิกัด Nameservers สู่เครือข่ายโลกอินเทอร์เน็ต
                        </p>
                    </div>
                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 7<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> โครงสร้างตารางแก้ไของค์ประกอบ Bind9 สมบูรณ์ (4 คะแนน) ผลแลบ Technitium GUI (4 คะแนน) สอบอธิบายสิทธิ์เอกสารจดโดเมน (2 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #f59e0b;">
                    <h4>💡 ข้อเท็จจริงน่าจำ: พอร์ตเครือข่าย DNS</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        โดยปกติระบบ DNS จะรับส่งข้อมูลคำถาม-คำตอบขนาดเล็กผ่าน <strong>Port 53 โปรโตคอล UDP</strong> เป็นหลักเพราะต้องการความรวดเร็วสูงสุด แต่ถ้าหากเป็นการแลกเปลี่ยนคัดลอกตารางผังขนาดใหญ่ระหว่างเซิร์ฟเวอร์หลักไปเซิร์ฟเวอร์สำรอง (Zone Transfer) ระบบจะสลับไปเรียกใช้ <strong>Port 53 โปรโตคอล TCP</strong> แทนเพื่อคุมความถูกต้องปลอดภัยของข้อมูลครับ
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>