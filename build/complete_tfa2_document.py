from pathlib import Path

from docx import Document
from docx.enum.table import WD_CELL_VERTICAL_ALIGNMENT, WD_TABLE_ALIGNMENT
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.oxml import OxmlElement
from docx.oxml.ns import qn
from docx.shared import Inches, Pt, RGBColor


SOURCE = Path(r"C:\COLLEGE\3rd year\WEB\TECHNICALS\IT0049 - TFA2 - From Arrays to a Real Database (CodeIgniter POS).docx")
OUTPUT = Path(r"C:\COLLEGE\3rd year\WEB\TECHNICALS\TA1\IT0049 - TFA2 - Completed Database Integration.docx")
CUSTOMER_SCREENSHOT = Path(r"C:\Users\angel\AppData\Local\Temp\codex-clipboard-85f14550-c9d9-4e83-b76a-43d923e14a5f.png")
USER_SCREENSHOT = Path(r"C:\Users\angel\AppData\Local\Temp\codex-clipboard-86af0e4b-a47f-48c9-a5e9-08bd3da55ca9.png")
STRUCTURE_SCREENSHOT = Path(r"C:\Users\angel\AppData\Local\Temp\codex-clipboard-a9d9018e-1f21-4ce6-851e-42f044a12f1d.png")

NAVY = "19324D"
PALE_BLUE = "EAF1F7"
LIGHT_GRAY = "D9D9D9"
ROW_ALT = "F6F8FA"
BLACK = RGBColor(0, 0, 0)


def set_cell_shading(cell, fill):
    tc_pr = cell._tc.get_or_add_tcPr()
    shd = tc_pr.find(qn("w:shd"))
    if shd is None:
        shd = OxmlElement("w:shd")
        tc_pr.append(shd)
    shd.set(qn("w:fill"), fill)


def set_cell_margins(cell, top=90, start=110, bottom=90, end=110):
    tc = cell._tc
    tc_pr = tc.get_or_add_tcPr()
    tc_mar = tc_pr.first_child_found_in("w:tcMar")
    if tc_mar is None:
        tc_mar = OxmlElement("w:tcMar")
        tc_pr.append(tc_mar)
    for margin, value in (("top", top), ("start", start), ("bottom", bottom), ("end", end)):
        node = tc_mar.find(qn(f"w:{margin}"))
        if node is None:
            node = OxmlElement(f"w:{margin}")
            tc_mar.append(node)
        node.set(qn("w:w"), str(value))
        node.set(qn("w:type"), "dxa")


def set_table_borders(table):
    tbl_pr = table._tbl.tblPr
    borders = tbl_pr.find(qn("w:tblBorders"))
    if borders is None:
        borders = OxmlElement("w:tblBorders")
        tbl_pr.append(borders)
    for edge in ("top", "left", "bottom", "right", "insideH", "insideV"):
        tag = qn(f"w:{edge}")
        element = borders.find(tag)
        if element is None:
            element = OxmlElement(f"w:{edge}")
            borders.append(element)
        element.set(qn("w:val"), "single")
        element.set(qn("w:sz"), "6")
        element.set(qn("w:space"), "0")
        element.set(qn("w:color"), LIGHT_GRAY)


def repeat_header(row):
    tr_pr = row._tr.get_or_add_trPr()
    tbl_header = OxmlElement("w:tblHeader")
    tbl_header.set(qn("w:val"), "true")
    tr_pr.append(tbl_header)


def keep_with_next(paragraph):
    paragraph.paragraph_format.keep_with_next = True


def set_run_font(run, name="Arial", size=10.5, bold=False, color=BLACK):
    run.font.name = name
    run._element.get_or_add_rPr().rFonts.set(qn("w:ascii"), name)
    run._element.get_or_add_rPr().rFonts.set(qn("w:hAnsi"), name)
    run.font.size = Pt(size)
    run.bold = bold
    run.font.color.rgb = color


def add_heading(doc, text, level=1):
    paragraph = doc.add_heading(text, level=level)
    paragraph.paragraph_format.space_before = Pt(14 if level == 1 else 10)
    paragraph.paragraph_format.space_after = Pt(6)
    keep_with_next(paragraph)
    for run in paragraph.runs:
        set_run_font(run, size=15 if level == 1 else 12, bold=True)
    return paragraph


def add_body(doc, text, bold_lead=None):
    paragraph = doc.add_paragraph()
    paragraph.paragraph_format.space_after = Pt(7)
    paragraph.paragraph_format.line_spacing = 1.1
    if bold_lead and text.startswith(bold_lead):
        first = paragraph.add_run(bold_lead)
        set_run_font(first, bold=True)
        rest = paragraph.add_run(text[len(bold_lead):])
        set_run_font(rest)
    else:
        run = paragraph.add_run(text)
        set_run_font(run)
    return paragraph


def add_bullets(doc, items):
    for item in items:
        paragraph = doc.add_paragraph()
        paragraph.paragraph_format.left_indent = Inches(0.28)
        paragraph.paragraph_format.first_line_indent = Inches(-0.18)
        paragraph.paragraph_format.space_after = Pt(3)
        bullet = paragraph.add_run("- ")
        set_run_font(bullet, bold=True)
        set_run_font(paragraph.add_run(item))


def add_code(doc, code):
    for line in code.strip("\n").splitlines():
        paragraph = doc.add_paragraph()
        paragraph.paragraph_format.left_indent = Inches(0.28)
        paragraph.paragraph_format.right_indent = Inches(0.18)
        paragraph.paragraph_format.space_after = Pt(0)
        paragraph.paragraph_format.line_spacing = 1.0
        run = paragraph.add_run(line if line else " ")
        set_run_font(run, name="Consolas", size=8.5)
    doc.add_paragraph().paragraph_format.space_after = Pt(2)


def add_table(doc, headers, rows, widths=None, font_size=9):
    table = doc.add_table(rows=1, cols=len(headers))
    table.alignment = WD_TABLE_ALIGNMENT.CENTER
    table.autofit = False
    set_table_borders(table)
    repeat_header(table.rows[0])

    for index, header in enumerate(headers):
        cell = table.rows[0].cells[index]
        set_cell_shading(cell, NAVY)
        set_cell_margins(cell)
        cell.vertical_alignment = WD_CELL_VERTICAL_ALIGNMENT.CENTER
        paragraph = cell.paragraphs[0]
        paragraph.alignment = WD_ALIGN_PARAGRAPH.CENTER
        paragraph.paragraph_format.space_after = Pt(0)
        run = paragraph.add_run(header)
        set_run_font(run, size=font_size, bold=True, color=RGBColor(255, 255, 255))

    for row_number, row_data in enumerate(rows):
        cells = table.add_row().cells
        for index, value in enumerate(row_data):
            cell = cells[index]
            if row_number % 2 == 1:
                set_cell_shading(cell, ROW_ALT)
            set_cell_margins(cell)
            cell.vertical_alignment = WD_CELL_VERTICAL_ALIGNMENT.CENTER
            paragraph = cell.paragraphs[0]
            paragraph.paragraph_format.space_after = Pt(0)
            paragraph.alignment = WD_ALIGN_PARAGRAPH.CENTER if index == 0 else WD_ALIGN_PARAGRAPH.LEFT
            run = paragraph.add_run(str(value))
            set_run_font(run, size=font_size)

    if widths:
        for row in table.rows:
            for index, width in enumerate(widths):
                row.cells[index].width = Inches(width)

    after = doc.add_paragraph()
    after.paragraph_format.space_after = Pt(3)
    return table


def add_caption(doc, text):
    paragraph = doc.add_paragraph()
    paragraph.alignment = WD_ALIGN_PARAGRAPH.CENTER
    paragraph.paragraph_format.space_before = Pt(4)
    paragraph.paragraph_format.space_after = Pt(10)
    run = paragraph.add_run(text)
    set_run_font(run, size=9)
    run.italic = True


doc = Document(SOURCE)

# Keep the original assessment instructions and append the completed implementation.
doc.add_page_break()

title = doc.add_paragraph(style="Title")
title.alignment = WD_ALIGN_PARAGRAPH.LEFT
title.paragraph_format.space_after = Pt(8)
title_run = title.add_run("Database Integration Implementation")
set_run_font(title_run, size=22, bold=True)

subtitle = doc.add_paragraph()
subtitle.paragraph_format.space_after = Pt(14)
subtitle_run = subtitle.add_run("IT0049 Technical Formative Assessment 2")
set_run_font(subtitle_run, size=11, bold=True)

add_body(
    doc,
    "This implementation continues the existing SimplePOS CodeIgniter 4 website. It connects CodeIgniter to the existing pos_database database, adds CustomerModel and UserModel, replaces both static arrays with Model queries, and exports the working database for repository submission.",
)

add_heading(doc, "Database Schema Used", 1)
add_body(
    doc,
    "The implementation uses the corrected account schema prepared for the preceding AI-reviewed database activity. These table names and fields are more detailed than the simplified example in the activity sheet, while still supporting the same Customer Accounts and User Accounts views.",
)

add_heading(doc, "Customer Accounts Table", 2)
add_table(
    doc,
    ["Field", "Data Type", "Constraint or Purpose"],
    [
        ["customer_id", "INT UNSIGNED", "Primary key and auto increment"],
        ["first_name", "VARCHAR(50)", "Required customer first name"],
        ["last_name", "VARCHAR(50)", "Required customer last name"],
        ["email", "VARCHAR(100)", "Required and unique"],
        ["phone", "VARCHAR(20)", "Required and preserves leading zero"],
        ["address", "VARCHAR(255)", "Optional address"],
        ["account_status", "VARCHAR(20)", "Required with Active default"],
        ["created_at", "DATETIME", "Required with current timestamp default"],
    ],
    widths=[1.45, 1.45, 3.85],
)

add_heading(doc, "User Accounts Table", 2)
add_table(
    doc,
    ["Field", "Data Type", "Constraint or Purpose"],
    [
        ["user_id", "INT UNSIGNED", "Primary key and auto increment"],
        ["username", "VARCHAR(50)", "Required and unique"],
        ["password_hash", "VARCHAR(255)", "Required password hash storage"],
        ["first_name", "VARCHAR(50)", "Required staff first name"],
        ["last_name", "VARCHAR(50)", "Required staff last name"],
        ["email", "VARCHAR(100)", "Required and unique"],
        ["role", "VARCHAR(20)", "Required staff role"],
        ["account_status", "VARCHAR(20)", "Required with Active default"],
        ["created_at", "DATETIME", "Required with current timestamp default"],
    ],
    widths=[1.45, 1.45, 3.85],
)

add_heading(doc, "Sample Database Records", 1)
add_heading(doc, "Five Customer Records", 2)
add_table(
    doc,
    ["ID", "Customer", "Email", "Phone", "Status"],
    [
        [1, "Juan Dela Cruz", "juan@example.com", "09171234567", "Active"],
        [2, "Maria Santos", "maria@example.com", "09181234567", "Active"],
        [3, "Carlo Reyes", "carlo@example.com", "09191234567", "Active"],
        [4, "Ana Garcia", "ana@example.com", "09201234567", "Inactive"],
        [5, "Luis Mendoza", "luis@example.com", "09211234567", "Active"],
    ],
    widths=[0.45, 1.45, 2.0, 1.35, 0.9],
    font_size=8.5,
)

add_heading(doc, "Five User and Staff Records", 2)
add_table(
    doc,
    ["ID", "Username", "Staff Name", "Role", "Status"],
    [
        [1, "admin01", "John Admin", "Admin", "Active"],
        [2, "cashier01", "Ella Cruz", "Cashier", "Active"],
        [3, "cashier02", "Mark Tan", "Cashier", "Active"],
        [4, "manager01", "Sofia Lim", "Manager", "Active"],
        [5, "cashier03", "Paul Ramos", "Cashier", "Inactive"],
    ],
    widths=[0.45, 1.35, 1.75, 1.2, 0.9],
    font_size=8.5,
)

add_heading(doc, "XAMPP and SQL Requirement", 1)
add_body(
    doc,
    "No SQL needs to be pasted into phpMyAdmin on the current computer because pos_database, customer_accounts, user_accounts, and all ten sample records already exist and were successfully queried.",
    bold_lead="No SQL needs to be pasted into phpMyAdmin on the current computer",
)
add_body(
    doc,
    "For a different computer, repository reviewer, or clean XAMPP installation, start Apache and MySQL, open phpMyAdmin, choose Import, and select database/pos_database.sql. Importing the file creates the database, both tables, their keys and constraints, and the sample records automatically.",
)

add_heading(doc, "CodeIgniter Database Connection", 1)
add_body(doc, "The project .env file contains the local XAMPP connection settings below.")
add_code(
    doc,
    """
database.default.hostname = 127.0.0.1
database.default.database = pos_database
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
""",
)

doc.add_page_break()
add_heading(doc, "CodeIgniter Models", 1)
add_body(doc, "Each Model identifies its MySQL table, primary key, return type, and allowed fields.")

add_heading(doc, "CustomerModel", 2)
add_code(
    doc,
    """
<?php

namespace App\\Models;

use CodeIgniter\\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'customer_id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'phone',
        'address', 'account_status',
    ];
}
""",
)

add_heading(doc, "UserModel", 2)
add_code(
    doc,
    """
<?php

namespace App\\Models;

use CodeIgniter\\Model;

class UserModel extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'username', 'password_hash', 'first_name', 'last_name',
        'email', 'role', 'account_status',
    ];
}
""",
)

add_heading(doc, "Short Reflection", 1)
add_body(
    doc,
    "Replacing the static arrays with Models made the account pages persistent without changing the overall MVC flow. The controllers now request records from MySQL, while the views continue to loop through arrays returned by CodeIgniter. This activity also showed why field names, primary keys, unique constraints, and safe output escaping must agree across the database, Model, controller, and view.",
)

controller_heading = add_heading(doc, "Controller Queries", 1)
controller_heading.paragraph_format.page_break_before = True
add_body(
    doc,
    "The controllers use Model methods backed by Query Builder. CONCAT creates the full_name value expected by the existing views, so the TFA1 page structure remains familiar.",
)

add_heading(doc, "Customers Controller Query", 2)
add_code(
    doc,
    """
$customerModel = new CustomerModel();
$customers = $customerModel
    ->select("CONCAT(first_name, ' ', last_name) AS full_name", false)
    ->select('email, phone, account_status')
    ->orderBy('customer_id', 'ASC')
    ->findAll();
""",
)

add_heading(doc, "Users Controller Query", 2)
add_code(
    doc,
    """
$userModel = new UserModel();
$users = $userModel
    ->select('username')
    ->select("CONCAT(first_name, ' ', last_name) AS full_name", false)
    ->select('role, account_status')
    ->orderBy('user_id', 'ASC')
    ->findAll();
""",
)

add_heading(doc, "View Integration", 1)
add_body(
    doc,
    "The existing foreach loops are retained. The views now receive Model results and escape every displayed value with esc(). The customer page shows name, email, phone, and status. The user page shows username, name, role, and status. The password_hash field is never selected or displayed.",
)

add_heading(doc, "Customer View Loop", 2)
add_code(
    doc,
    """
<?php foreach ($customers as $customer): ?>
    <tr>
        <td><?= esc($customer['full_name']) ?></td>
        <td><?= esc($customer['email']) ?></td>
        <td><?= esc($customer['phone']) ?></td>
        <td><?= esc($customer['account_status']) ?></td>
    </tr>
<?php endforeach ?>
""",
)

add_heading(doc, "User View Loop", 2)
add_code(
    doc,
    """
<?php foreach ($users as $user): ?>
    <tr>
        <td><?= esc($user['username']) ?></td>
        <td><?= esc($user['full_name']) ?></td>
        <td><?= esc($user['role']) ?></td>
        <td><?= esc($user['account_status']) ?></td>
    </tr>
<?php endforeach ?>
""",
)

add_heading(doc, "Verification Results", 1)
add_table(
    doc,
    ["Check", "Result"],
    [
        ["Customer page HTTP response", "200 OK"],
        ["Customer rows displayed", "5"],
        ["Known customer found", "Juan Dela Cruz"],
        ["User page HTTP response", "200 OK"],
        ["User rows displayed", "5"],
        ["Known username found", "admin01"],
        ["PHP syntax checks", "Passed for both Models and controllers"],
    ],
    widths=[2.75, 3.9],
)

add_heading(doc, "Database Evidence", 1)
for image_path, caption in (
    (STRUCTURE_SCREENSHOT, "Figure 1  customer_accounts field types, primary key, auto increment, and unique email index"),
    (CUSTOMER_SCREENSHOT, "Figure 2  Five customer account records in phpMyAdmin"),
    (USER_SCREENSHOT, "Figure 3  Five user and staff account records in phpMyAdmin"),
):
    if image_path.exists():
        paragraph = doc.add_paragraph()
        paragraph.alignment = WD_ALIGN_PARAGRAPH.CENTER
        run = paragraph.add_run()
        run.add_picture(str(image_path), width=Inches(6.0))
        add_caption(doc, caption)

add_heading(doc, "Final Submission Checklist", 1)
add_table(
    doc,
    ["Submission Item", "Status"],
    [
        ["CodeIgniter project files", "Completed in the TA1 project folder"],
        ["Database export", "Completed as database/pos_database.sql"],
        ["Database-backed customer page", "Completed and verified"],
        ["Database-backed user page", "Completed and verified"],
        ["GitHub repository link", "Add after uploading the project"],
        ["Hosted application link", "Add after deploying the project"],
    ],
    widths=[3.1, 3.55],
    font_size=8.5,
)

# Normalize appended heading colors to black and keep the original document unchanged.
for paragraph in doc.paragraphs:
    if paragraph.style and paragraph.style.name in {"Title", "Heading 1", "Heading 2"}:
        for run in paragraph.runs:
            run.font.color.rgb = BLACK

OUTPUT.parent.mkdir(parents=True, exist_ok=True)
doc.save(OUTPUT)
print(OUTPUT)
