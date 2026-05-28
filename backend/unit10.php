<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 10: Project Documentation & Deployment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .checklist-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .checklist-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .checklist-icon {
            color: #16a34a;
            font-size: 1.2rem;
            margin-right: 10px;
            line-height: 1.2;
        }

        .terminal-box {
            background-color: #0f172a;
            color: #a5b4fc;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Consolas', monospace;
            font-size: 0.95rem;
            margin: 10px 0;
            border-left: 4px solid #6366f1;
        }

        .step-badge {
            background: #2563eb;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-right: 5px;
        }

        .warning-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 15px 0;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">
                <span class="arrow-icon">⬅</span>
                <span>กลับสู่หน้าหลักวิชา</span>
            </a>
            <h2>หน่วยที่ 10: Project Documentation & Deployment</h2>
            <p>สัปดาห์ที่ 16-17 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        การเขียนโค้ดเสร็จบนเครื่อง <code class="inline-code">localhost</code> ไม่ได้แปลว่าโปรเจกต์เสร็จสมบูรณ์! ก่อนที่เราจะส่งมอบซอฟต์แวร์ให้ลูกค้าหรือนำขึ้น <strong>Production (เซิร์ฟเวอร์จริง)</strong> เราจำเป็นต้องจัดทำคู่มือ (Documentation) ให้ชัดเจน จัดการตัวแปรความลับ (Environment Variables) ป้องกันปัญหาการข้ามโดเมน (CORS) และใช้เครื่องมืออย่าง <strong>PM2</strong> เพื่อรันแอปพลิเคชันให้ทำงานอยู่เบื้องหลังตลอดเวลาแม้ออกจากระบบไปแล้ว
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>📄 1. การจัดทำคู่มือโปรเจกต์ (README.md)</h3>
                <p><strong>README.md</strong> คือหน้าตาของโปรเจกต์ เมื่อเราอัปโหลดซอฟต์แวร์ขึ้น GitHub หรือส่งมอบงานให้ทีมอื่น ไฟล์นี้จะเป็นสิ่งแรกที่โปรแกรมเมอร์คนอื่นอ่าน โครงสร้างที่ดีควรประกอบด้วย:</p>

                <div class="checklist-box">
                    <div class="checklist-item">
                        <span class="checklist-icon">✅</span>
                        <div><strong>1. Project Title & Description:</strong> ชื่อระบบและคำอธิบายสั้นๆ ว่าระบบนี้ทำหน้าที่อะไร</div>
                    </div>
                    <div class="checklist-item">
                        <span class="checklist-icon">✅</span>
                        <div><strong>2. Prerequisites:</strong> สิ่งที่ต้องติดตั้งก่อนใช้งาน (เช่น Node.js v18+, MySQL 8.0)</div>
                    </div>
                    <div class="checklist-item">
                        <span class="checklist-icon">✅</span>
                        <div><strong>3. Installation:</strong> คำสั่งทีละขั้นตอนในการติดตั้ง (เช่น <code>npm install</code>)</div>
                    </div>
                    <div class="checklist-item">
                        <span class="checklist-icon">✅</span>
                        <div><strong>4. Environment Variables:</strong> อธิบายว่าไฟล์ <code>.env</code> ต้องมีตัวแปรอะไรบ้าง (แต่ห้ามใส่ค่าความลับจริงลงไป)</div>
                    </div>
                    <div class="checklist-item">
                        <span class="checklist-icon">✅</span>
                        <div><strong>5. API Reference:</strong> ลิงก์ไปยัง Swagger UI หรือระบุ Endpoint ที่สำคัญ</div>
                    </div>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>⚙️ 2. การเตรียมความพร้อมก่อนขึ้น Production</h3>
                <p>เมื่อแอปพลิเคชันของเราต้องไปอยู่บนอินเทอร์เน็ต เราต้องตั้งค่า 2 สิ่งสำคัญ ได้แก่ ความปลอดภัยของข้อมูลความลับ และการอนุญาตให้ Front-end ฝั่งผู้ใช้งานเข้ามาเชื่อมต่อได้</p>

                <h4>2.1 การซ่อนความลับด้วย Environment Variables (dotenv)</h4>
                <p>รหัสผ่าน Database, JWT Secret, และ Port ต่างๆ <strong>ห้าม</strong> เขียนฝังไว้ในโค้ดโดยตรง (Hardcode) เพราะหากใครเห็นโค้ดของเราก็จะเข้าถึงฐานข้อมูลได้ทันที เราจะแยกข้อมูลพวกนี้ไปไว้ในไฟล์ <code class="inline-code">.env</code></p>
                <div class="code-window" style="margin-bottom: 15px;">
                    <div class="code-header"><span>.env</span><button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button></div>
                    <pre><code>PORT=5000
DB_HOST=localhost
DB_USER=root
DB_PASS=my_secure_password
JWT_SECRET=super_secret_key_123</code></pre>
                </div>

                <h4>2.2 การจัดการ CORS (Cross-Origin Resource Sharing)</h4>
                <div class="warning-box">
                    <strong>⚠️ ปัญหาโลกแตกของนักพัฒนา:</strong><br>
                    เมื่อนักศึกษาเขียน API อยู่ที่ <code class="inline-code">http://localhost:3000</code> แต่ Front-end (React/Vue) รันอยู่ที่ <code class="inline-code">http://localhost:5173</code> เบราว์เซอร์จะ <strong>บล็อก</strong> การดึงข้อมูลข้ามพอร์ตหรือข้ามโดเมนทันทีเพื่อความปลอดภัย เราจึงต้องใช้แพ็กเกจ <code>cors</code> ใน Express เพื่อปลดล็อกให้โดเมนที่ได้รับอนุญาตสามารถดึงข้อมูลได้
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🚀 3. การรันเซิร์ฟเวอร์แบบไม่มีวันตายด้วย PM2</h3>

                <p>ปกติเราใช้คำสั่ง <code class="inline-code">node app.js</code> ในการรันเซิร์ฟเวอร์ แต่เมื่อเรา <strong>ปิดหน้าต่าง Terminal</strong> หรือเน็ตตัด เซิร์ฟเวอร์ก็จะดับตามไปด้วย! บน Production เราจึงต้องใช้ <strong>PM2 (Process Manager)</strong> ซึ่งเป็นตัวจัดการที่จะรันแอปของเราไว้เบื้องหลัง (Background) และถ้าแอปเกิด Crash พังขึ้นมา PM2 จะทำการ Auto-Restart ให้เราอัตโนมัติ</p>

                <h4>คำสั่งพื้นฐานของ PM2:</h4>
                <div class="terminal-box">
                    $ npm install -g pm2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#64748b;">// ติดตั้ง PM2 ลงในเครื่องแบบ Global</span><br>
                    $ pm2 start app.js --name "my-api" <span style="color:#64748b;">// สั่งรันแอปพลิเคชันและตั้งชื่อ</span><br>
                    $ pm2 list &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#64748b;">// ดูรายชื่อแอปทั้งหมดที่กำลังรันอยู่</span><br>
                    $ pm2 logs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#64748b;">// ดูประวัติการบันทึก (Console.log / Error)</span><br>
                    $ pm2 restart my-api &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#64748b;">// สั่งรีสตาร์ทเมื่อมีการอัปเดตโค้ด</span><br>
                    $ pm2 stop my-api &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#64748b;">// สั่งหยุดการทำงาน</span>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 4. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> การเตรียมโปรเจกต์ API เข้าสู่โหมด Production (Production-Ready Setup)</p>
                <p><strong>วัตถุประสงค์:</strong> ให้นักศึกษานำโปรเจกต์เดิมมาประกอบร่างเข้ากับ dotenv, cors และทดสอบรันแบบ Background Service ด้วย PM2</p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> ติดตั้ง Dependencies สำหรับ Production</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm install express dotenv cors
npm install -g pm2</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 2</span> สร้างไฟล์ <code class="inline-code">.env</code> และกำหนดตัวแปรดังนี้:</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>PORT=8000
NODE_ENV=production</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 3</span> ปรับปรุงไฟล์ <strong><code class="inline-code">app.js</code></strong> เพื่อเรียกใช้งาน Environment Variables และ CORS</p>
                </div>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (app.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>// 1. โหลดตัวแปรจากไฟล์ .env เข้าสู่กระบวนการของ Node
require('dotenv').config();

const express = require('express');
const cors = require('cors');

const app = express();

// 2. ตั้งค่า CORS ให้อนุญาตเฉพาะ Domain ที่กำหนด (ในที่นี้จำลองว่าให้เข้าได้ทุกที่ด้วยเงื่อนไขพื้นฐาน)
app.use(cors()); 
app.use(express.json());

// 3. ดึงค่า PORT จาก .env ถ้าไม่มีให้ใช้ 3000 เป็นค่าเริ่มต้น
const PORT = process.env.PORT || 3000;
const ENV = process.env.NODE_ENV || 'development';

app.get('/api/status', (req, res) => {
    res.status(200).json({
        status: "Online",
        environment: ENV,
        message: "ระบบพร้อมให้บริการแล้ว!"
    });
});

app.listen(PORT, () => {
    console.log(`🚀 Production Server is running on port ${PORT}`);
});</code></pre>
                </div>

                <div style="margin-top: 15px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> ปิดเซิร์ฟเวอร์เดิมที่รันอยู่ทั้งหมด แล้วสั่งรันด้วย PM2:</p>
                    <div class="terminal-box" style="margin: 5px 0 15px 0;">
                        $ pm2 start app.js --name "final-project-api"
                    </div>
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> ปิดหน้าต่าง Terminal ทิ้งไปเลย! จากนั้นเปิดเบราว์เซอร์ไปที่ <code class="inline-code">http://localhost:8000/api/status</code> จะพบว่า API ยังคงทำงานและตอบสนองได้ปกติ นี่คือพลังของ PM2!</p>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Final Assignment)</h3>
                <p><strong>ใบงานที่ 10: The Final Release (การส่งมอบระบบอย่างเต็มรูปแบบ)</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษานำโปรเจกต์ที่สมบูรณ์ที่สุดจากใบงานก่อนหน้า (เช่น ระบบจัดการสินค้าที่มี Database และ JWT) มาดำเนินการดังนี้:</li>
                    <li>1. ย้ายค่าตัวแปรการเชื่อมต่อ Database และรหัสลับ JWT ทั้งหมดไปไว้ในไฟล์ <strong><code class="inline-code">.env</code></strong> และแก้ไขโค้ดให้เรียกผ่าน <code class="inline-code">process.env</code></li>
                    <li>2. เปิดใช้งาน <strong>CORS</strong> ในไฟล์หลัก</li>
                    <li>3. สร้างไฟล์ <strong><code class="inline-code">README.md</code></strong> อธิบายวิธีการรันโปรเจกต์ของตนเองให้ครบถ้วนตามหลักการ</li>
                    <li>4. สั่งรันโปรเจกต์ด้วย <strong>PM2</strong> </li>
                    <li><strong>วิธีการส่งงาน:</strong> บีบอัดไฟล์โปรเจกต์ทั้งหมด (<strong>ห้าม</strong> แนบโฟลเดอร์ <code class="inline-code">node_modules</code> มาเด็ดขาด แต่<strong>ต้อง</strong>แนบไฟล์ <code class="inline-code">.env</code> มาเพื่อให้ตรวจได้) พร้อมกับแนบรูปภาพหน้าจอขณะใช้คำสั่ง <code class="inline-code">pm2 list</code> ที่แสดงสถานะว่าโปรเจกต์กำลัง Online อยู่</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 10 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• การจัดโครงสร้างไฟล์ README.md ได้อย่างมืออาชีพ อ่านเข้าใจง่าย (3 คะแนน)</li>
                    <li>• การประยุกต์ใช้ Environment Variables (.env) แทนการ Hardcode ได้สมบูรณ์ 100% (3 คะแนน)</li>
                    <li>• การเปิดใช้งาน CORS และจัดการเรื่องพอร์ตได้อย่างถูกต้อง (2 คะแนน)</li>
                    <li>• หลักฐานภาพหน้าจอการทำงานของ PM2 (2 คะแนน)</li>
                </ul>
                <div style="margin-top: 15px; text-align: center; color: #16a34a; font-weight: bold; font-size: 1.1rem;">
                    🎉 ยินดีด้วย! นักศึกษาได้ผ่านกระบวนการเรียนรู้และสร้างระบบ Back-End ครบทุกมิติแล้ว 🎉
                </div>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>