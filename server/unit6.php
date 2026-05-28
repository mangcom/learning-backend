<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นไปที่ Root เพื่อให้เรียกคอมโพเนนต์ได้ถูกต้อง
$active_nav = "server"; // ไฮไลต์เมนูที่วิชา Server
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 6: Firewall และความปลอดภัยพื้นฐานประจำเครื่อง</title>
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
                <span class="course-code" style="background: #10b981; color: #fff;">หน่วยที่ 6 (สัปดาห์ที่ 6)</span>
                <h2 style="margin: 10px 0 5px 0; font-size: 1.8rem; font-weight: 700;">Firewall และความปลอดภัยพื้นฐานประจำเครื่อง</h2>
                <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">เรียนรู้สถาปัตยกรรมกำแพงไฟภายใน การทำงานของพอร์ตเชื่อมต่อเครือข่าย และการบริหารนโยบายความปลอดภัยเพื่อป้องกันผู้บุกรุก</p>
            </div>
        </div>
    </div>

    <div class="container">
        <main>
            <div class="content-area">

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">📘 ภาคทฤษฎี: แนวคิดกำแพงไฟและสถาปัตยกรรมพอร์ต</h3>

                    <h4>1. แนวคิดกำแพงไฟป้องกันระบบ (Firewall Concept)</h4>
                    <p>ในโลกของความปลอดภัยไซเบอร์ เซิร์ฟเวอร์ที่ไม่มีไฟร์วอลล์เปรียบเสมือนบ้านที่เปิดประตูทิ้งไว้ทุกบาน <strong>Firewall (กำแพงไฟ)</strong> ระดับโฮสต์ ทำหน้าที่เป็นด่านตรวจคนเข้าเมืองส่วนบุคคล คอยคัดกรองแพ็กเก็ตข้อมูล (Data Packets) ที่วิ่งเข้า-ออกการ์ดเครือข่ายตามชุดกฎเกณฑ์ (Rules) ที่ผู้ดูแลระบบกำหนด</p>
                    <p>หลักการสากลในการตั้งค่าไฟร์วอลล์ที่ดีคือ <strong>Default Deny Policy</strong> หมายความว่า <em>"ปฏิเสธทุกการเชื่อมต่อจากภายนอกไว้ก่อน แล้วเลือกอนุญาตเฉพาะบริการที่จำเป็นต้องเปิดบริการจริงๆ เท่านั้น"</em></p>

                    <h4 style="margin-top: 25px;">2. การทำงานของพอร์ตเครือข่ายและโปรโตคอล (Network Ports)</h4>
                    <p>เครื่องเซิร์ฟเวอร์หนึ่งเครื่องสามารถเปิดบริการพร้อมกันได้หลายร้อยบริการผ่านหมายเลขช่องทางที่เรียกว่า <strong>Port (พอร์ต)</strong> ซึ่งมีหมายเลขตั้งแต่ 0 ถึง 65535 แบ่งออกเป็นสองโปรโตคอลหลัก:</p>
                    <ul>
                        <li><strong>TCP (Transmission Control Protocol):</strong> เน้นความถูกต้อง แม่นยำ ส่งข้อมูลแบบต้องมีการตอบรับ (Three-way Handshake) เช่น เว็บไซต์ (HTTP/HTTPS) หรือรีโมท (SSH)</li>
                        <li><strong>UDP (User Datagram Protocol):</strong> เน้นความเร็ว ไม่สนใจการตอบรับ ส่งข้อมูลไปทันที เช่น ระบบสตรีมมิ่ง วิดีโอคอล หรือระบบค้นหาไอพี (DNS)</li>
                    </ul>

                    <h4 style="margin-top: 25px;">3. พอร์ตมาตรฐานที่ผู้ดูแลระบบต้องทราบ</h4>
                    <table class="grading-table" style="margin: 15px 0; background: #f8fafc;">
                        <thead>
                            <tr style="background: #cbd5e1;">
                                <th style="padding: 10px; width: 20%; text-align: center;">หมายเลขพอร์ต</th>
                                <th style="padding: 10px; width: 25%;">โปรโตคอล / บริการ</th>
                                <th style="padding: 10px;">ความเสี่ยงและหน้าที่ทำงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><code>22</code></td>
                                <td>SSH (Secure Shell)</td>
                                <td>ช่องทางคุมระบบระยะไกล (เป้าหมายสูงสุดในการสุ่มรหัสโจมตี)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><code>80 / 443</code></td>
                                <td>HTTP / HTTPS</td>
                                <td>บริการหน้าเว็บปกติ และเว็บแบบเข้ารหัสความปลอดภัย (SSL/TLS)</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><code>53</code></td>
                                <td>DNS (Domain Name)</td>
                                <td>ให้บริการแปลชื่อโดเนม มักทำงานบน UDP เป็นหลัก</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><code>3306</code></td>
                                <td>MySQL / MariaDB</td>
                                <td>ระบบฐานข้อมูลภายในองค์กร (ห้ามเปิดให้คนนอกเข้าถึงเด็ดขาด)</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                    <h3 class="section-title">💻 ภาคปฏิบัติ: การสแกนพอร์ตภายในและการจัดการ UFW</h3>

                    <h4>1. การใช้คำสั่งตรวจสอบพอร์ตระบบ (Socket Statistics)</h4>
                    <p>ก่อนจะเปิดกำแพงไฟ แอดมินต้องสืบทราบก่อนว่าในเครื่องเราแอบเปิดพอร์ตอะไรทิ้งไว้บ้าง โดยใช้คำสั่ง <strong><code>ss</code></strong> แทนคำสั่ง <code>netstat</code> แบบโบราณ:</p>
                    <div class="code-window">
                        <div class="code-header"><span class="code-lang">Terminal</span></div>
                        <pre>sudo ss -tulnp</pre>
                    </div>

                    <div class="analogy-box" style="background: #eff6ff; border-left: 4px solid #2563eb; margin-top: 10px;">
                        <strong>🔍 ถอดรหัสออปชันคำสั่ง <code>-tulnp</code>:</strong>
                        <ul style="margin-top: 5px; padding-left: 20px; list-style-type: none;">
                            <li>• <strong>-t</strong> : ส่องเฉพาะพอร์ตประเภท TCP</li>
                            <li>• <strong>-u</strong> : ส่องเฉพาะพอร์ตประเภท UDP</li>
                            <li>• <strong>-l</strong> : เลือกดูเฉพาะพอร์ตที่กำลังเปิดรอรับข้อมูล (Listening)</li>
                            <li>• <strong>-n</strong> : แสดงผลเป็นตัวเลขหมายเลขพอร์ตโดยตรง ไม่ต้องแปลเป็นชื่อคำอ่าน</li>
                            <li>• <strong>-p</strong> : แสดงชื่อโปรแกรมและเลข PID ตัวจริงที่ผูกยึดพอร์ตนั้นไว้</li>
                        </ul>
                    </div>

                    <h4 style="margin-top: 25px;">2. ระบบควบคุมไฟร์วอลล์อย่างง่าย UFW (Uncomplicated Firewall)</h4>
                    <p>ลินุกซ์ตระกูล Ubuntu มาพร้อมเครื่องมือจัดการหน้าบ้านของระบบ iptables ที่เขียนง่ายขึ้น เรียกว่า <strong>UFW</strong> สรุปชุดคำสั่งที่ต้องจดจำมีดังนี้:</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 8px; border-bottom: 1px dashed #e2e8f0;">🛡️ <code>sudo ufw status verbose</code> : เช็คสถานะการทำงานและกฎทั้งหมดที่บังคับใช้อยู่</li>
                        <li style="padding: 8px; border-bottom: 1px dashed #e2e8f0;">🛡️ <code>sudo ufw allow [port/protocol]</code> : สั่งเปิดรับข้อมูลผ่านพอร์ต เช่น <code>sudo ufw allow 80/tcp</code></li>
                        <li style="padding: 8px; border-bottom: 1px dashed #e2e8f0;">🛡️ <code>sudo ufw deny [port]</code> : สั่งบล็อกทางเข้าออกของพอร์ตเป้าหมาย</li>
                        <li style="padding: 8px; border-bottom: 1px dashed #e2e8f0;">🛡️ <code>sudo ufw delete allow [port]</code> : ลบกฎการอนุญาตเดิมที่เคยตั้งทิ้งไว้</li>
                        <li style="padding: 8px; border-bottom: 1px dashed #e2e8f0;">🛡️ <code>sudo ufw enable</code> : สั่งเริ่มเปิดระบบกำแพงไฟให้ทำงานจริง</li>
                        <li style="padding: 8px;">🛡️ <code>sudo ufw disable</code> : ปิดการทำงานระบบไฟร์วอลล์ทั้งหมด</li>
                    </ul>
                </section>

                <section class="lesson-section class-card" style="background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h3 class="section-title">🧪 Hands-on Lab: การวิเคราะห์พอร์ตความเสี่ยงและการล็อกความปลอดภัย</h3>
                    <div class="assignment-box">
                        <strong>🎯 สถานการณ์จำลอง:</strong> เครื่องเซิร์ฟเวอร์โดนทีมตรวจสอบไอทีแจ้งเตือนว่ามีการเปิดพอร์ตฐานข้อมูลทิ้งไว้ และระบบไร้การเปิดใช้งานไฟร์วอลล์ ให้นักศึกษาทำการสแกนหาข้อเท็จจริง และเปิดกฎเหล็กอนุญาตเฉพาะเว็บเซิร์ฟเวอร์ (พอร์ต 80) และ พอร์ต SSH พิเศษ (พอร์ต 2222 จากหน่วยเรียนที่ 4) เท่านั้น นอกนั้นต้องโดนดีดทิ้งทั้งหมด
                    </div>

                    <h4 style="margin-top: 20px;">ขั้นตอนการปฏิบัติภารกิจ:</h4>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 1</span>
                        <p>พิมพ์คำสั่งตรวจสอบพอร์ตขยะและบริการที่แอบซ่อนรันอยู่ภายในเครื่องทั้งหมด แล้วแคปเจอร์รูปภาพบันทึกพอร์ตที่สุ่มเสี่ยง</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo ss -tulnp</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 2</span>
                        <p>เช็คสถานะการทำงานปัจจุบันของไฟร์วอลล์UFW ซึ่งค่าเริ่มต้นจากโรงงานมักจะรายงานข้อความว่า <code>Status: inactive</code></p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo ufw status</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 3</span>
                        <p><strong>[สำคัญมาก]</strong> ทำการตั้งกฎเพิ่มรายชื่อพอร์ตควบคุมระบบ และพอร์ตเว็บเข้าสู่รายการปลอดภัย "ก่อน" สั่งเปิดไฟร์วอลล์จริง</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo ufw allow 2222/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 4</span>
                        <p>ทำการเปิดระบบไฟร์วอลล์ให้เริ่มทำงานจริงจัง โดยระบบจะมีข้อความเตือนภัยเรื่องการตัดการรีโมท ให้กดพิมพ์อักษร <code>y</code> แล้วยืนยัน <code>Enter</code></p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo ufw enable</pre>
                        </div>
                    </div>

                    <div class="step-box">
                        <span class="step-num">ขั้นตอนที่ 5</span>
                        <p>ส่องสรุปตารางรายชื่อสิทธิ์การเข้าออก เพื่อตรวจสอบความชัวร์ว่าพอร์ตอื่นๆ เช่น พอร์ตฐานข้อมูลโดนคัดแยกสิทธิ์ปิดกั้นเรียบร้อยแล้ว</p>
                        <div class="code-window">
                            <div class="code-header"><span class="code-lang">Terminal</span></div>
                            <pre>sudo ufw status verbose</pre>
                        </div>
                        <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;">⚠️ <em>ส่งใบรายงานโดยบันทึกตารางผลลัพธ์ UFW ล่าสุดที่ระบุว่าอนุญาตเฉพาะพอร์ต 2222, 80 และ 443 เท่านั้น</em></p>
                    </div>

                </section>
            </div>

            <aside>
                <div class="sidebar-card">
                    <h4>📋 ข้อมูลประจำหน่วย</h4>
                    <p style="font-size: 0.9rem; color: #475569;">
                        <strong>สัปดาห์ที่:</strong> 6<br>
                        <strong>เวลาเรียน:</strong> 5 ชั่วโมง (ทฤษฎี 1, ปฏิบัติ 4)<br>
                        <strong>เกณฑ์การประเมิน:</strong> ผลสัมฤทธิ์ของตาราง UFW คัดกรองพอร์ตตามโจทย์สำเร็จ (5 คะแนน) สอบวิเคราะห์ความปลอดภัยเสี่ยง (5 คะแนน)
                    </p>
                </div>

                <div class="sidebar-card" style="border-left: 4px solid #ef4444;">
                    <h4>🚨 คำเตือนร้ายแรงสุดในวิชาชีพ</h4>
                    <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5;">
                        ห้ามสั่งคำสั่ง <strong><code>sudo ufw enable</code></strong> โดยที่ยังไม่ได้แอดพอร์ตควบคุมระยะไกล (เช่น 22 หรือ 2222) เข้าไปเด็ดขาด! การทำเช่นนั้นจะทำให้ระบบเตะแอดมินหลุดจากการเชื่อมต่อทันที และจะไม่สามารถล็อกอินผ่านโปรแกรม PuTTY หรือ VS Code เข้าไปแก้หน้างานได้อีกเลย ต้องไปต่อหน้าจอจริงที่ตู้แร็คเซิร์ฟเวอร์เท่านั้นครับ
                    </p>
                </div>
            </aside>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>