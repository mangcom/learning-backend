<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 9: Integration Testing & Error Logging</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .testing-pyramid-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }

        .log-terminal {
            background-color: #0f172a;
            color: #38bdf8;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Consolas', monospace;
            font-size: 0.9rem;
            margin: 10px 0;
            line-height: 1.6;
        }

        .jest-pass {
            color: #22c55e;
        }

        /* สีเขียวสำหรับ Test Pass */
        .jest-fail {
            color: #ef4444;
        }

        /* สีแดงสำหรับ Test Fail */

        .theory-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .theory-grid {
                grid-template-columns: 1fr;
            }
        }

        .theory-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border-top: 4px solid #2563eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
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

        .info-alert {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
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
            <h2>หน่วยที่ 9: Integration Testing & Error Logging</h2>
            <p>สัปดาห์ที่ 14-15 | เวลาเรียนรวม 10 ชั่วโมง (ทฤษฎี 2 ชม. ปฏิบัติ 8 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญประจำหน่วย (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        การเขียนโค้ดให้ทำงานได้คือสเตปแรก แต่การทำให้ระบบ <strong>"เสถียรและตรวจสอบได้"</strong> คือหัวใจของวิศวกรซอฟต์แวร์ระดับโปรดักชัน ในหน่วยนี้เราจะศึกษา 2 แกนหลัก ได้แก่ <strong>1. Error Logging:</strong> การเลิกใช้แค่ <code>console.log</code> แล้วหันมาใช้ระบบบันทึกข้อผิดพลาดลงไฟล์อย่างเป็นระบบ และ <strong>2. Integration Testing:</strong> การเขียนโค้ดเพื่อมา "ทดสอบโค้ดของเราเอง" แบบอัตโนมัติ เพื่อยืนยันว่า API ที่เราสร้างขึ้นมานั้นทำงานถูกต้องร่วมกับฐานข้อมูลและส่วนประกอบอื่น ๆ โดยไม่พังเมื่อมีการแก้ไขโค้ดในอนาคต
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>📝 1. ทฤษฎีการจัดการบันทึกข้อผิดพลาด (Error Logging)</h3>
                <div class="theory-grid">
                    <div class="theory-card" style="border-top-color: #f59e0b;">
                        <h4 style="margin-top:0;">ทำไม <code>console.log()</code> ถึงไม่พอ?</h4>
                        <p style="font-size: 0.9rem; color: #475569;">ในตอนที่เราพัฒนาระบบบนเครื่องตัวเอง <code>console.log</code> นั้นเพียงพอ แต่เมื่อนำขึ้นเซิร์ฟเวอร์จริง (Production) ข้อความเหล่านั้นจะหายไปเมื่อปิดหน้าจอ Terminal หากเกิดบั๊ก เราจะไม่สามารถย้อนกลับมาดูประวัติได้เลย</p>
                    </div>
                    <div class="theory-card" style="border-top-color: #10b981;">
                        <h4 style="margin-top:0;">ระดับของการบันทึก (Log Levels)</h4>
                        <ul style="font-size: 0.9rem; color: #475569; padding-left: 20px;">
                            <li><strong style="color:#ef4444;">ERROR:</strong> ระบบพัง, ฐานข้อมูลหลุด (ต้องรีบแก้ด่วน)</li>
                            <li><strong style="color:#f59e0b;">WARN:</strong> สิ่งผิดปกติแต่ระบบยังเดินต่อได้</li>
                            <li><strong style="color:#3b82f6;">INFO:</strong> บันทึกเหตุการณ์ปกติ เช่น User ล็อกอิน</li>
                            <li><strong style="color:#64748b;">DEBUG:</strong> ตัวแปรเชิงลึก ใช้ตอนไล่หาบั๊กเท่านั้น</li>
                        </ul>
                    </div>
                </div>
                <p><strong>เครื่องมือยอดนิยมใน Node.js:</strong> เราจะใช้ <strong>Winston</strong> (ตัวจัดการการบันทึกลงไฟล์และการแสดงผลสี) คู่กับ <strong>Morgan</strong> (Middleware สำเร็จรูปที่คอยบันทึกทุกๆ Request ที่วิ่งเข้ามาหา Express อัตโนมัติ)</p>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🧪 2. ทฤษฎีการทดสอบระบบแบบบูรณาการ (Integration Testing)</h3>
                <p>การทดสอบซอฟต์แวร์มีหลายระดับ ในวงการมักเปรียบเทียบเป็น <strong>Testing Pyramid</strong> ดังนี้:</p>



                [Image of Software Testing Pyramid]


                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li><strong>Unit Testing (ฐานพีระมิด):</strong> ทดสอบฟังก์ชันย่อยทีละตัว (เช่น ฟังก์ชันบวกเลข) ทำได้เร็วและเยอะที่สุด</li>
                    <li><strong>Integration Testing (ตรงกลาง):</strong> ทดสอบการทำงานร่วมกันของหลายๆ โมดูล เช่น <em>"เรียก Endpoint /api/users แล้วมันไปดึงข้อมูลจาก Database มาส่งกลับเป็น JSON 200 OK ได้ถูกต้องไหม?"</em> (โฟกัสหลักของหน่วยนี้)</li>
                    <li><strong>E2E / UI Testing (ยอดพีระมิด):</strong> จำลองบอทมาคลิกหน้าเว็บเหมือนคนจริงๆ ทำได้ช้าและเขียนยากสุด</li>
                </ul>

                <div class="info-alert">
                    <strong>💡 เครื่องมือที่เราจะใช้:</strong> <br>
                    1. <strong>Jest:</strong> Framework สำหรับการรันการทดสอบ (Test Runner) ที่มีระบบ Assertions ยืนยันผลลัพธ์ในตัว <br>
                    2. <strong>Supertest:</strong> ไลบรารีสำหรับจำลองการยิง HTTP Request (GET, POST) ไปหาแอป Express ของเราโดยไม่ต้องเปิด Server ทิ้งไว้จริงๆ
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 3. ปฏิบัติการที่ 1: ติดตั้ง Centralized Error Logging</h3>

                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> ติดตั้งแพ็กเกจที่จำเป็นสำหรับระบบ Logging</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm install express morgan winston</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 2</span> สร้างไฟล์ <strong><code class="inline-code">logger.js</code></strong> เพื่อตั้งค่า Winston ให้เขียน Log ลงไฟล์</p>
                </div>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (logger.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const winston = require('winston');

// ตั้งค่ารูปแบบการแสดงผล (Format)
const logFormat = winston.format.combine(
    winston.format.timestamp({ format: 'YYYY-MM-DD HH:mm:ss' }),
    winston.format.printf(info => `[${info.timestamp}] ${info.level.toUpperCase()}: ${info.message}`)
);

// สร้างตัว Logger
const logger = winston.createLogger({
    level: 'info',
    format: logFormat,
    transports: [
        // 1. ให้พิมพ์ออกหน้าจอ Terminal ด้วย (ใส่สีให้ดูง่าย)
        new winston.transports.Console({
            format: winston.format.combine(winston.format.colorize(), logFormat)
        }),
        // 2. ให้บันทึก Level Error ลงไฟล์ error.log
        new winston.transports.File({ filename: 'logs/error.log', level: 'error' }),
        // 3. ให้บันทึกทุก Level ลงไฟล์ combined.log
        new winston.transports.File({ filename: 'logs/combined.log' })
    ]
});

module.exports = logger;</code></pre>
                </div>

                <div style="margin-top: 20px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> สร้างไฟล์ <strong><code class="inline-code">app.js</code></strong> นำ Morgan มาจับคู่กับ Winston</p>
                </div>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (app.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const express = require('express');
const morgan = require('morgan');
const logger = require('./logger'); // ดึงไฟล์ที่เราตั้งค่าไว้มาใช้

const app = express();
app.use(express.json());

// บอกให้ Morgan โยน Log ของ HTTP Request ไปให้ Winston จัดการบันทึก
app.use(morgan('short', { stream: { write: message => logger.info(message.trim()) } }));

app.get('/api/data', (req, res) => {
    res.json({ message: "ดึงข้อมูลสำเร็จ!" });
});

// จำลองการเกิด Error
app.get('/api/error', (req, res) => {
    logger.error("เกิดข้อผิดพลาดร้ายแรง ฐานข้อมูลไม่ตอบสนอง!");
    res.status(500).json({ error: "Internal Server Error" });
});

app.listen(3000, () => logger.info('🚀 Server รันที่พอร์ต 3000'));</code></pre>
                </div>
                <p>ลองรัน <code class="inline-code">node app.js</code> แล้วเปิดเบราว์เซอร์เข้าลิงก์ต่างๆ จากนั้นสังเกตว่าจะมีโฟลเดอร์ <code class="inline-code">logs/</code> ถูกสร้างขึ้นอัตโนมัติพร้อมบันทึกประวัติไว้ทั้งหมด!</p>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🧪 4. ปฏิบัติการที่ 2: การเขียนโค้ดทดสอบ (Integration Testing ด้วย Jest)</h3>

                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> ติดตั้ง Jest และ Supertest <strong>(สังเกต --save-dev เพราะใช้แค่ตอนเขียนโค้ด ไม่ใช้ตอนนำขึ้นเซิร์ฟเวอร์จริง)</strong></p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>npm install jest supertest --save-dev</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 2</span> เปิดไฟล์ <strong><code class="inline-code">package.json</code></strong> และแก้คำสั่ง scripts ช่อง test ให้เป็น jest:</p>
                    <div class="code-window" style="margin: 5px 0 15px 0;">
                        <pre><code>"scripts": {
  "test": "jest"
}</code></pre>
                    </div>

                    <p><span class="step-badge">ขั้นตอนที่ 3</span> สร้างไฟล์ <strong><code class="inline-code">api.test.js</code></strong> สำหรับเขียนเงื่อนไขการทดสอบ (Jest จะหาไฟล์ที่มีคำว่า `.test.js` อัตโนมัติ)</p>
                </div>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (api.test.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const request = require('supertest');
const express = require('express');

// จำลองแอป Express ขนาดเล็กเพื่อทำการทดสอบ
const app = express();
app.use(express.json());

app.get('/api/users', (req, res) => {
    res.status(200).json([{ id: 1, name: "Somchai" }]);
});

app.post('/api/users', (req, res) => {
    if (!req.body.name) return res.status(400).json({ error: "Name is required" });
    res.status(201).json({ id: 2, name: req.body.name });
});

// =====================================
// 🧪 เริ่มเขียน Test Suite
// =====================================
describe('Integration Testing สำหรับ Users API', () => {
    
    // Test Case ที่ 1
    it('ควรส่งข้อมูลกลับมาเป็น Status 200 และมี Array ข้อมูล (GET)', async () => {
        const response = await request(app).get('/api/users');
        
        expect(response.statusCode).toBe(200); // คาดหวังว่า Status ต้องเป็น 200
        expect(Array.isArray(response.body)).toBeTruthy(); // คาดหวังว่า Body ต้องเป็น Array
        expect(response.body[0].name).toBe("Somchai");
    });

    // Test Case ที่ 2
    it('ควรส่ง Status 400 ถ้าไม่ส่งชื่อมาตอนสร้าง User (POST)', async () => {
        const response = await request(app).post('/api/users').send({}); // แกล้งส่งบอดี้ว่างๆ
        
        expect(response.statusCode).toBe(400);
        expect(response.body.error).toBe("Name is required");
    });
});</code></pre>
                </div>

                <div style="margin-top: 15px;">
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> สั่งรันชุดทดสอบด้วยคำสั่ง:</p>
                    <div class="code-window" style="margin: 5px 0;">
                        <pre><code>npm run test</code></pre>
                    </div>
                    <p><strong>ตัวอย่างหน้าจอผลลัพธ์ (Terminal):</strong></p>
                    <div class="log-terminal">
                        > jest<br>
                        PASS ./api.test.js<br>
                        Integration Testing สำหรับ Users API<br>
                        &nbsp;&nbsp;<span class="jest-pass">✓</span> ควรส่งข้อมูลกลับมาเป็น Status 200 และมี Array ข้อมูล (GET) (35 ms)<br>
                        &nbsp;&nbsp;<span class="jest-pass">✓</span> ควรส่ง Status 400 ถ้าไม่ส่งชื่อมาตอนสร้าง User (POST) (12 ms)<br><br>
                        <span style="color:#fff;">Test Suites:</span> <span class="jest-pass">1 passed</span>, 1 total<br>
                        <span style="color:#fff;">Tests:</span> <span class="jest-pass">2 passed</span>, 2 total
                    </div>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 9: พัฒนาระบบ API พร้อมเขียน Test Case ควบคุมคุณภาพ</strong></p>
                <br>
                <p><strong>คำสั่งในการปฏิบัติงาน:</strong></p>
                <ul style="margin-left: 20px; line-height: 1.8;">
                    <li>ให้นักศึกษาสร้าง Express API จำลองระบบ <strong>"เครื่องคิดเลข (Calculator API)"</strong></li>
                    <li>ประกอบด้วย 1 Endpoint: <code class="inline-code">POST /api/calculate</code> โดยรับค่า Body เป็น <code class="inline-code">{ "num1": 10, "num2": 5, "operator": "+" }</code></li>
                    <li>ติดตั้งและใช้งาน <strong>Winston</strong> เพื่อบันทึก Request ที่เข้ามาลงไฟล์ <code class="inline-code">calc.log</code></li>
                    <li>สร้างไฟล์ <code class="inline-code">calc.test.js</code> และเขียน <strong>Integration Test จำนวน 3 เคส</strong> (เช่น เคสบวกเลขสำเร็จ, เคสส่งข้อมูลตัวอักษรไปแทนตัวเลขต้องได้ 400, เคสหารด้วยศูนย์ต้องได้ 400)</li>
                    <li>ส่งงานโดยการแคปภาพหน้าจอ Terminal ที่รัน <code>npm run test</code> ผ่านทั้ง 3 เคส (ต้องขึ้นตัวอักษรสีเขียว PASS) และเปิดไฟล์ <code>calc.log</code> เพื่อโชว์หลักฐานการบันทึก Log</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การให้คะแนนตัดเกรดประเมินผล (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• การประยุกต์ใช้ Winston และ Morgan ในการบันทึก Log ลงไฟล์สำเร็จ (1.5 คะแนน)</li>
                    <li>• การเขียน Test Case ด้วย Jest และ Supertest ได้ครบถ้วนตามเงื่อนไขครอบคลุม (2.5 คะแนน)</li>
                    <li>• หลักฐานหน้าจอแสดงผลการทดสอบ (Pass) และไฟล์ Log มีความเป็นระเบียบ (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>