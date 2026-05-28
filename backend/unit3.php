<?php
$base_dir = "../"; // ถอยกลับ 1 ชั้นเพื่อไปหาโฟลเดอร์หลัก
$active_nav = "backend"; // เปิดสถานะเมนูที่วิชา Back-End
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยที่ 3: Node.js Fundamentals & Core Modules</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* สไตล์เพิ่มเติมเฉพาะหน้าเพื่อความสมบูรณ์ */
        .lesson-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .lesson-table th,
        .lesson-table td {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            text-align: left;
            font-size: 0.95rem;
        }

        .lesson-table th {
            background-color: #0f172a;
            color: #fff;
            font-weight: 600;
        }

        .lesson-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .command-list {
            background: #1e293b;
            color: #f8fafc;
            padding: 15px 20px;
            border-radius: 8px;
            list-style: none;
            margin: 15px 0;
            font-family: 'Consolas', monospace;
        }

        .command-list li {
            margin-bottom: 8px;
        }

        .command-list li strong {
            color: #38bdf8;
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
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="page-header" style="background-color: var(--secondary); color: var(--white); padding: 40px 0;">
        <div class="container">
            <a href="index.php" class="back-link">⬅ กลับสู่หน้าหลักวิชา</a>
            <h2>หน่วยที่ 3: Node.js Fundamentals & Core Modules</h2>
            <p>สัปดาห์ที่ 3 | เวลาเรียน 5 ชั่วโมง (ทฤษฎี 1 ชม. ปฏิบัติ 4 ชม.)</p>
        </div>
    </div>

    <div class="container">
        <div class="single-layout">

            <section class="lesson-section">
                <div class="key-concept-box">
                    <strong>🎯 สารสำคัญ (Key Concepts)</strong>
                    <p style="margin-top: 5px; font-size: 0.95rem; color: #334155;">
                        Node.js เปลี่ยนโลกการพัฒนาเว็บด้วยการนำ JavaScript มาทำงานฝั่ง Server-side ผ่าน Google V8 Engine โดยมีหัวใจสำคัญคือสถาปัตยกรรมแบบ <strong>Asynchronous & Non-blocking I/O</strong> ที่ช่วยให้จัดการกับ Request ปริมาณมากได้อย่างมีประสิทธิภาพ นอกจากนี้ยังมี <strong>Core Modules</strong> เช่น <code class="inline-code">fs</code> (File System) ที่ช่วยจัดการไฟล์ในระบบ และระบบ <strong>NPM</strong> (Node Package Manager) ซึ่งเป็นคลังระบบจัดการไลบรารีที่ใหญ่ที่สุดในโลก
                    </p>
                </div>
            </section>

            <section class="lesson-section">
                <h3>📑 1. ทฤษฎีพื้นฐาน Node.js และสถาปัตยกรรมภายใน</h3>
                <br>
                <h4>1.1 Node.js คืออะไร?</h4>
                <p>Node.js ไม่ใช่ภาษาโปรแกรมมิ่งใหม่ และไม่ใช่ Framework แต่เป็น <strong>JavaScript Runtime Environment</strong> ที่สร้างขึ้นบน <strong>Google V8 JavaScript Engine</strong> (ตัวเดียวกับที่อยู่ในเบราว์เซอร์ Chrome) ทำให้เราสามารถรันโค้ด JavaScript บนเครื่องเซิร์ฟเวอร์ได้โดยไม่ต้องพึ่งพาเบราว์เซอร์อีกต่อไป</p>

                <br>
                <h4>1.2 ความแตกต่างระหว่าง Blocking I/O กับ Non-blocking I/O</h4>
                <p>รูปแบบการทำงานของ Node.js จะใช้แนวคิด <strong>Single-Threaded, Non-blocking I/O</strong> ซึ่งทำงานแตกต่างจากภาษาฝั่ง Server ยุคก่อน (เช่น PHP แบบดั้งเดิม) ที่เป็นลักษณะ Multi-Threaded/Blocking</p>

                <table class="lesson-table">
                    <thead>
                        <tr>
                            <th>คุณลักษณะ</th>
                            <th>Blocking I/O (Synchronous)</th>
                            <th>Non-blocking I/O (Asynchronous)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>รูปแบบการทำงาน</strong></td>
                            <td>ทำงานทีละบรรทัดจากบนลงล่าง คำสั่งถัดไปต้องรอให้คำสั่งปัจจุบันเสร็จก่อน</td>
                            <td>ส่งคำสั่งไปทำงานพื้นหลังทันที ไม่รอผลลัพธ์ สามารถข้ามไปทำคำสั่งถัดไปได้เลย</td>
                        </tr>
                        <tr>
                            <td><strong>การใช้ Thread</strong></td>
                            <td>1 Request = เปิด 1 Thread (กินทรัพยากรระบบสูงเมื่อมีผู้ใช้ปริมาณมาก)</td>
                            <td>ใช้ Thread เดียว (Single Thread) มอบหมายงานให้ระบบจัดสรรภายหลัง</td>
                        </tr>
                        <tr>
                            <td><strong>การตอบสนอง</strong></td>
                            <td>เกิดอาการ "ค้าง" (Block) หากต้องอ่านไฟล์ขนาดใหญ่หรือดึงข้อมูลนาน</td>
                            <td>ลื่นไหล ไม่ค้าง เมื่อทำงานเสร็จจะแจ้งเตือนผ่าน <strong>Callback Function</strong></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>🛠️ 2. ระบบจัดการไฟล์ภายใน (fs module)</h3>
                <p>โมดูล <code class="inline-code">fs</code> (File System) เป็น Core Module ของ Node.js ที่ช่วยให้เราสามารถ อ่าน, เขียน, อัปเดต หรือลบไฟล์บนเซิร์ฟเวอร์ได้ โดยโมดูลนี้จะมีฟังก์ชันให้เลือกใช้ 2 รูปแบบเสมอ คือแบบ Sync (Blocking) และแบบ Async (Non-blocking)</p>

                <br>
                <h4>2.1 โค้ดเปรียบเทียบการอ่านไฟล์ (Sync vs Async)</h4>

                <p><strong>รูปแบบที่ 1: การอ่านไฟล์แบบ Synchronous (readFileSync)</strong><br>โค้ดจะหยุดรอจนกว่าจะอ่านไฟล์เสร็จสิ้น เหมาะสำหรับไฟล์ตั้งค่าระบบขนาดเล็กที่จำเป็นต้องโหลดให้เสร็จก่อนเริ่มรันระบบ</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (readFileSync)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const fs = require('fs');

console.log("🚀 [1] เริ่มต้นการอ่านไฟล์...");

try {
    // โค้ดจะหยุดกักที่บรรทัดนี้จนกว่าจะอ่านไฟล์เสร็จ
    const data = fs.readFileSync('data.txt', 'utf8');
    console.log("📄 [2] เนื้อหาภายในไฟล์คือ:", data);
} catch (err) {
    console.error("❌ เกิดข้อผิดพลาดในการอ่านไฟล์:", err);
}

console.log("🏁 [3] จบการทำงานซิงโครนัส");</code></pre>
                </div>

                <p style="margin-top: 15px;"><strong>รูปแบบที่ 2: การอ่านไฟล์แบบ Asynchronous (readFile)</strong><br>โค้ดจะส่งคำสั่งอ่านไฟล์ไปทำที่ระบบหลังบ้าน แล้วข้ามไปรันบรรทัดถัดไปทันที เมื่ออ่านไฟล์เสร็จสิ้น ค่อยย้อนกลับมาทำงานใน Callback Function</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (readFile)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const fs = require('fs');

console.log("🚀 [1] เริ่มต้นการอ่านไฟล์...");

// ส่งงานอ่านไฟล์ไปทำเบื้องหลัง แล้วข้ามไปทำคำสั่งถัดไปทันที
fs.readFile('data.txt', 'utf8', (err, data) => {
    if (err) {
        console.error("❌ เกิดข้อผิดพลาด:", err);
        return;
    }
    console.log("📄 [3] เนื้อหาภายในไฟล์คือ:", data);
});

console.log("🏁 [2] จบการทำงานอซิงโครนัส (คำสั่งถัดไปทำก่อนไฟล์จะอ่านเสร็จ)");</code></pre>
                </div>
                <p style="font-size: 0.9rem; color: #ef4444; margin-top: 5px;">*จุดสังเกต: ลำดับการแสดงผลหน้าจอแบบ Async จะเป็น [1] ➔ [2] ➔ [3] เนื่องจากโค้ดไม่รอการอ่านไฟล์</p>

                <br>
                <h4>2.2 การเขียนและบันทึกไฟล์ (writeFile)</h4>
                <p>ใช้สำหรับสร้างไฟล์ใหม่หรือเขียนข้อมูลทับลงบนไฟล์เดิมแบบอซิงโครนัส:</p>

                <div class="code-window">
                    <div class="code-header">
                        <span>javascript (writeFile)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>const fs = require('fs');

const content = "ข้อมูลบันทึกระบบประจำวัน: " + new Date();

fs.writeFile('log.txt', content, 'utf8', (err) => {
    if (err) {
        console.error("❌ ไม่สามารถเขียนไฟล์ได้:", err);
        return;
    }
    console.log("💾 บันทึกไฟล์ log.txt สำเร็จแล้ว!");
});</code></pre>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>📦 3. การควบคุมระบบผ่าน Node Package Manager (NPM)</h3>
                <p><strong>NPM</strong> คือเครื่องมือจัดการแพ็กเกจ (Package Manager) สำหรับ JavaScript ที่ช่วยให้นักพัฒนาสามารถดาวน์โหลดคลังโค้ด (Libraries/Frameworks) ของผู้อื่นบนอินเทอร์เน็ตมาใช้งานในโปรเจกต์ได้อย่างรวดเร็ว</p>

                <br>
                <h4>3.1 คำสั่งสั่งการ NPM ที่จำเป็น</h4>
                <ul class="command-list">
                    <li><strong>npm init</strong> : เริ่มต้นสร้างโปรเจกต์ Node.js (ระบบจะให้กรอกรายละเอียด)</li>
                    <li><strong>npm init -y</strong> : เริ่มต้นสร้างโปรเจกต์อย่างรวดเร็วโดยข้ามขั้นตอนการถามคำถาม (สร้างไฟล์ package.json ทันที)</li>
                    <li><strong>npm install &lt;package-name&gt;</strong> : ดาวน์โหลดโมดูลภายนอกมาติดตั้งในโปรเจกต์</li>
                    <li><strong>npm install &lt;package-name&gt; --save-dev</strong> : ติดตั้งโมดูลสำหรับใช้ในขั้นตอนพัฒนาเท่านั้น (เช่น Nodemon)</li>
                    <li><strong>npm uninstall &lt;package-name&gt;</strong> : ถอนการติดตั้งโมดูลที่ไม่ใช้งานออกจากโปรเจกต์</li>
                </ul>

                <br>
                <h4>3.2 โครงสร้างระบบหลังใช้ NPM</h4>
                <p>เมื่อรันคำสั่งติดตั้งโมดูลภายนอก ระบบจะสร้างโครงสร้างเหล่านี้ขึ้นมาโดยอัตโนมัติ:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li><strong>package.json</strong> : ไฟล์ประวัติและสรุปใบสั่งรายการ (Manifest file) เก็บรหัส ชื่อโปรเจกต์ และรายชื่อไลบรารีพร้อมเวอร์ชันที่จำเป็น</li>
                    <li><strong>node_modules/</strong> : โฟลเดอร์ที่เก็บซอร์สโค้ดจริง ๆ ของคลังไลบรารีที่เราดาวน์โหลดมา <span style="color: #ef4444;">(ข้อควรระวัง: ห้ามอัปโหลดโฟลเดอร์นี้ขึ้น GitHub ให้ใช้ไฟล์ package.json เพื่อเปิดโอกาสให้ผู้อื่นรัน npm install เอง)</span></li>
                </ul>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="lesson-section">
                <h3>💻 4. ปฏิบัติการประจำหน่วย (Lab Exercise)</h3>
                <p><strong>🚀 ชื่องาน:</strong> ระบบบันทึกประวัติการทำงานเซิร์ฟเวอร์ (Simple Server Logger)</p>
                <p><strong>วัตถุประสงค์:</strong> ฝึกฝนการนำโมดูล <code class="inline-code">fs</code> มาประยุกต์ร่วมกับโมดูลภายนอกที่ติดตั้งผ่านระบบ <code class="inline-code">npm</code></p>

                <br>
                <h4>🛠️ ขั้นตอนการทดลอง:</h4>
                <div style="margin-top: 10px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 1</span> สร้างโฟลเดอร์โครงงานใหม่ชื่อ <code class="inline-code">node-logger-lab</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 2</span> เปิด Terminal เข้าไปในโฟลเดอร์นั้น แล้วพิมพ์คำสั่งเริ่มต้นโปรเจกต์: <code class="inline-code">npm init -y</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 3</span> ติดตั้งโมดูลภายนอกชื่อ <strong>chalk</strong> เวอร์ชัน 4 เพื่อใช้สำหรับเปลี่ยนสีข้อความบน Terminal ให้สวยงาม: <code class="inline-code">npm install chalk@4</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 4</span> สร้างไฟล์ชื่อ <code class="inline-code">logger.js</code> และเขียนโค้ดตามตัวอย่างด้านล่างนี้:</p>
                </div>

                <div class="code-window" style="margin-top: 15px;">
                    <div class="code-header">
                        <span>javascript (logger.js)</span>
                        <button class="copy-icon-btn" onclick="copyCode(this)">📋 คัดลอก</button>
                    </div>
                    <pre><code>// logger.js
const fs = require('fs');
const chalk = require('chalk'); // ดึงโมดูลภายนอกที่โหลดผ่าน npm มาใช้งาน

// ฟังก์ชันสำหรับบันทึก Log ระบบ
function logMessage(level, message) {
    const timestamp = new Date().toISOString();
    const rawLog = `[${timestamp}] [${level.toUpperCase()}]: ${message}\n`;

    // 1. บันทึกข้อมูลลงไฟล์ระบบแบบต่อท้าย (Append File) เป็น Non-blocking
    fs.appendFile('server.log', rawLog, 'utf8', (err) => {
        if (err) {
            console.error(chalk.red("❌ ผิดพลาด: ไม่สามารถบันทึกไฟล์ได้!"));
            return;
        }
        
        // 2. แสดงผลบนหน้าจอ Terminal แบบแยกสีตามความรุนแรงด้วย Chalk
        if (level === 'info') {
            console.log(chalk.blue("ℹ️  INFO: ") + message);
        } else if (level === 'warning') {
            console.log(chalk.yellow("⚠️  WARNING: ") + message);
        } else if (level === 'error') {
            console.log(chalk.red.bold("🚨 ERROR: ") + message);
        }
    });
}

// --- ทดสอบเรียกใช้งานฟังก์ชัน ---
console.log(chalk.green.inverse("⚙️ เริ่มต้นทดสอบระบบจำลองการทำงานเซิร์ฟเวอร์... \n"));

logMessage('info', 'เซิร์ฟเวอร์เริ่มต้นระบบบน Port 3000 สำเร็จ');
logMessage('warning', 'การเชื่อมต่อฐานข้อมูลล่าช้ากว่าปกติ (Response time &gt; 500ms)');
logMessage('info', 'ผู้ใช้งานรหัส USER-77840 ทำการล็อกอินเข้าสู่ระบบ');
logMessage('error', 'ไม่สามารถเชื่อมต่อฐานข้อมูลหลักได้! (Connection Timeout)');</code></pre>
                </div>

                <div style="margin-top: 15px; line-height: 1.8;">
                    <p><span class="step-badge">ขั้นตอนที่ 5</span> รันโปรแกรมผ่าน Terminal ด้วยคำสั่ง: <code class="inline-code">node logger.js</code></p>
                    <p><span class="step-badge">ขั้นตอนที่ 6</span> ตรวจสอบการแสดงผลสีบน Terminal และตรวจสอบว่ามีไฟล์ <code class="inline-code">server.log</code> ถูกสร้างขึ้นในโฟลเดอร์หรือไม่</p>
                </div>
            </section>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #cbd5e1;">

            <section class="assignment-box">
                <h3>📝 5. งานที่มอบหมายและเกณฑ์การประเมินผล (Assignment)</h3>
                <p><strong>ใบงานที่ 3: ระบบจัดการคลังข้อมูลนักศึกษาผ่านเท็กซ์ไฟล์</strong></p>
                <br>
                <p><strong>คำสั่ง:</strong></p>
                <ul style="margin-left: 20px;">
                    <li>ให้นักศึกษาเขียนโปรแกรม Node.js โดยสร้างไฟล์ชื่อ <code class="inline-code">studentManager.js</code></li>
                    <li>สร้างฟังก์ชันที่รับอาร์เรย์ของวัตถุข้อมูลนักศึกษา (รหัสนักศึกษา, ชื่อ, เกรดเฉลี่ย) แล้วใช้ <code class="inline-code">fs.writeFile</code> แปลงอาร์เรย์นั้นเป็นรูปแบบ JSON สตริง (<code class="inline-code">JSON.stringify()</code>) บันทึกเก็บไว้ในชื่อไฟล์ <code class="inline-code">students.json</code></li>
                    <li>เขียนฟังก์ชันอ่านไฟล์ <code class="inline-code">students.json</code> กลับขึ้นมา และใช้แพ็กเกจ <strong>chalk</strong> ตกแต่งสีข้อความเกรดเฉลี่ยของนักศึกษา (เช่น เกรดมากกว่า 3.50 ให้แสดงชื่อเป็นสีเขียว หากต่ำกว่า 2.00 ให้แสดงชื่อเป็นตัวหนาสีแดง)</li>
                </ul>

                <br>
                <p><strong>📊 เกณฑ์การตัดคะแนน (คะแนนเต็ม 5 คะแนน):</strong></p>
                <ul style="margin-left: 20px; font-size: 0.9rem; color: #78350f;">
                    <li>• ความถูกต้องทางเทคนิคในการอ่าน-เขียนไฟล์แบบ Non-blocking และการจัดการ JSON (2 คะแนน)</li>
                    <li>• การประยุกต์ใช้ระบบ NPM ในการสร้างและติดตั้งโมดูลภายนอกได้ถูกต้อง (1 คะแนน)</li>
                    <li>• การจัดระเบียบการแสดงผลลัพธ์บน Terminal ด้วยสีสันที่สอดคล้องกับเงื่อนไข (1 คะแนน)</li>
                    <li>• ความสะอาดของ Source Code, การ Comment อธิบายงาน และความตรงต่อเวลา (1 คะแนน)</li>
                </ul>
            </section>

        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>