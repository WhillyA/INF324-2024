using System.Data;
using System.Data.SqlClient;

namespace _324_1205
{

	public partial class Form1 : Form
	{
		int cId, cIdx, cR, cG, cB;
		String cNombre, cColor, nombrexx;
		String vec = "TT";
		SqlConnection conn;
		SqlDataAdapter ada;
		private Bitmap ImagenCopia;
		private Bitmap xImagenCopia;

		public Form1()
		{
			InitializeComponent();
			conn = new SqlConnection("Data Source=DESKTOP-RPSMGR5; Initial Catalog=TexturasDB; Integrated Security=true;");
			ada = new SqlDataAdapter();
		}

		private void button1_Click(object sender, EventArgs e)
		{
			openFileDialog1.Filter = "archivos jpg|*.jpg";
			openFileDialog1.ShowDialog();
			Bitmap bmp = new Bitmap(openFileDialog1.FileName);
			pictureBox1.Image = bmp;
		}

		private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
		{
			Bitmap bmp = new Bitmap(pictureBox1.Image);
			Color c = new Color();

			int sR, sG, sB;
			sR = 0; sG = 0; sB = 0;
			for (int i = e.X; i < e.X + 10; i++)
			{
				for (int j = e.Y; j < e.Y + 10; j++)
				{
					c = bmp.GetPixel(i, j);
					sR += c.R;
					sG += c.G;
					sB += c.B;
				}
			}
			sR = sR / 100;
			sG = sG / 100;
			sB = sB / 100;
			textBox1.Text = sR.ToString();
			textBox2.Text = sG.ToString();
			textBox3.Text = sB.ToString();
		}

		private void button2_Click(object sender, EventArgs e)
		{
			Bitmap bmp1 = new Bitmap(pictureBox1.Image);
			Bitmap bmp2 = new Bitmap(bmp1.Width, bmp1.Height);
			Color c = new Color();
			for (int i = 0; i < bmp1.Width; i++)
			{
				for (int j = 0; j < bmp1.Height; j++)
				{
					c = bmp1.GetPixel(i, j);
					if (((180 <= c.R) && (c.R <= 220)) && ((140 <= c.G) && (c.G <= 200)) && ((140 <= c.B) && (c.B <= 160)))
					{
						bmp2.SetPixel(i, j, Color.Pink);
					}
					else
					{
						bmp2.SetPixel(i, j, Color.FromArgb(c.R, c.G, c.B));
					}
				}
			}
			pictureBox2.Image = bmp2;
		}

		private void button3_Click(object sender, EventArgs e)
		{
			Bitmap bmp = new Bitmap(pictureBox1.Image);
			Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
			Color c = new Color();
			int sR, sG, sB;
			for (int i = 0; i < bmp.Width - 10; i = i + 10)
			{
				for (int j = 0; j < bmp.Height - 10; j = j + 10)
				{
					sR = 0; sG = 0; sB = 0;
					for (int ip = i; ip < i + 10; ip++)
					{
						for (int jp = j; jp < j + 10; jp++)
						{
							c = bmp.GetPixel(ip, jp);
							sR = sR + c.R;
							sG = sG + c.G;
							sB = sB + c.B;
						}
					}
					sR = sR / 100;
					sG = sG / 100;
					sB = sB / 100;

					if (((180 <= c.R) && (c.R <= 220)) && ((140 <= c.G) && (c.G <= 200)) && ((140 <= c.B) && (c.B <= 160)))
					{
						for (int ip = i; ip < i + 10; ip++)
						{
							for (int jp = j; jp < j + 10; jp++)
							{
								bmp2.SetPixel(ip, jp, Color.Black);
							}
						}
					}
					else
					{
						for (int ip = i; ip < i + 10; ip++)
						{
							for (int jp = j; jp < j + 10; jp++)
							{
								c = bmp.GetPixel(ip, jp);
								bmp2.SetPixel(ip, jp, Color.FromArgb(c.R, c.G, c.B));
							}
						}
					}
				}
			}
			pictureBox2.Image = bmp2;
		}

		private void mostrar()
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				ada.SelectCommand = new SqlCommand("SELECT * FROM Texturas", conn);
				DataSet ds = new DataSet();
				ada.Fill(ds);
				dataGridView1.DataSource = ds.Tables[0];

				conn.Close();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
		}
		private void mostrar_Activa()
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				ada.SelectCommand = new SqlCommand("SELECT * FROM Texturas_Activa", conn);
				DataSet ds = new DataSet();
				ada.Fill(ds);
				dataGridView2.DataSource = ds.Tables[0];

				conn.Close();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
		}

		private void Form1_Load(object sender, EventArgs e)
		{
			mostrar();
			mostrar_Activa();
		}

		private void pictureBox2_Click(object sender, EventArgs e)
		{

		}

		private void button4_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				string query = "INSERT INTO Texturas(nombre, r, g, b, color) VALUES(@nombre, @r, @g, @b, @color)";

				using (SqlCommand cmd = new SqlCommand(query, conn))
				{
					cmd.Parameters.AddWithValue("@nombre", textBox5.Text);
					cmd.Parameters.AddWithValue("@r", int.Parse(textBox1.Text));
					cmd.Parameters.AddWithValue("@g", int.Parse(textBox2.Text));
					cmd.Parameters.AddWithValue("@b", int.Parse(textBox3.Text));
					cmd.Parameters.AddWithValue("@color", textBox4.Text);

					cmd.ExecuteNonQuery();
					textBox1.Text = "";
					textBox2.Text = "";
					textBox3.Text = "";
					textBox4.Text = "";
					textBox5.Text = "";

				}

				conn.Close();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Error: " + ex.Message);
			}

			mostrar();
		}

		private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
		{
			if (dataGridView1.Rows[e.RowIndex].Cells[e.ColumnIndex].Value != null)
			{
				dataGridView1.CurrentRow.Selected = true;
				cId = Convert.ToInt32(dataGridView1.Rows[e.RowIndex].Cells[0].Value);
			}
		}

		private void button6_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				string query = "SELECT * FROM Texturas WHERE Id = @cId";

				SqlCommand command = new SqlCommand(query, conn);
				command.Parameters.AddWithValue("@cId", cId);

				SqlDataAdapter ada = new SqlDataAdapter(command);

				DataSet ds = new DataSet();
				ada.Fill(ds);


				string query1 = "INSERT INTO Texturas_Activa(nombre, r, g, b, color) VALUES(@nombre, @r, @g, @b, @color)";

				foreach (DataRow row in ds.Tables[0].Rows)
				{
					using (SqlCommand cmd = new SqlCommand(query1, conn))
					{
						cmd.Parameters.AddWithValue("@nombre", row["nombre"]);
						cmd.Parameters.AddWithValue("@r", row["r"]);
						cmd.Parameters.AddWithValue("@g", row["g"]);
						cmd.Parameters.AddWithValue("@b", row["b"]);
						cmd.Parameters.AddWithValue("@color", row["color"]);

						cmd.ExecuteNonQuery();
					}
				}

				conn.Close();
				mostrar_Activa();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
		}

		private void dataGridView2_CellClick(object sender, DataGridViewCellEventArgs e)
		{
			if (e.RowIndex >= 0 && e.ColumnIndex >= 0)
			{
				if (dataGridView2.Rows[e.RowIndex].Cells[e.ColumnIndex].Value != null)
				{
					dataGridView2.CurrentRow.Selected = true;
					cIdx = Convert.ToInt32(dataGridView2.Rows[e.RowIndex].Cells[0].Value);

					try
					{
						if (conn.State == ConnectionState.Closed)
						{
							conn.Open();
						}

						string query = "SELECT * FROM Texturas_Activa WHERE Id = @cIdx";
						SqlCommand command = new SqlCommand(query, conn);
						command.Parameters.AddWithValue("@cIdx", cIdx);

						SqlDataReader Leer = command.ExecuteReader();

						if (Leer.Read())
						{

							cNombre = Leer["Nombre"].ToString();
							cR = Convert.ToInt32(Leer["R"]);
							cG = Convert.ToInt32(Leer["G"]);
							cB = Convert.ToInt32(Leer["B"]);
							cColor = Leer["Color"].ToString();
							textBox1.Text = cNombre + cR + cG + cB + cColor;
						}

						Leer.Close();
						conn.Close();
						Modificar(cIdx, cNombre, cR, cG, cB, cColor);

						MessageBox.Show($"Nombre: {cNombre}, R: {cR}, G: {cG}, B: {cB}, Color: {cColor}");
					}
					catch (Exception ex)
					{
						MessageBox.Show("An error occurred: " + ex.Message);
					}
				}
			}
		}
		private void Modificar(int xxId, String nombrexx,int xcR, int xcG, int xcB, String xColor)
		{

			Bitmap bmp = ImagenCopia;
			Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
			Color c = new Color();
			int cont = 0;
			int tR, tG, tB;
			Color replacementColor;
			try
			{
				replacementColor = Color.FromName(xColor);
				if (!replacementColor.IsKnownColor)
				{
					throw new ArgumentException("El color especificado no es válido.");
				}
			}
			catch
			{
				throw new ArgumentException("El color especificado no es válido.");
			}

			for (int i = 0; i < bmp.Width - 10; i = i + 10)
			{
				for (int j = 0; j < bmp.Height - 10; j = j + 10)
				{
					tR = 0; tG = 0; tB = 0;
					for (int ip = i; ip < i + 10; ip++)
					{
						for (int jp = j; jp < j + 10; jp++)
						{
							c = bmp.GetPixel(ip, jp);
							tR = tR + c.R;
							tG = tG + c.G;
							tB = tB + c.B;
						}
					}
					tR = tR / 100;
					tG = tG / 100;
					tB = tB / 100;

					if (((xcR - 10 <= tR) && (tR <= xcR + 10)) && ((xcG - 10 <= tG) && (tG <= xcG + 10)) && ((xcB - 10 <= tB) && (tB <= xcB + 10)))
					{
						for (int ip = i; ip < i + 10; ip++)
						{
							for (int jp = j; jp < j + 10; jp++)
							{
								bmp2.SetPixel(ip, jp, replacementColor);
								

							}
						}
						cont++;
						if(cont == 1)
						{ 
							vec += ","+xxId+", " + nombrexx + " ," + xColor; 
						}
						
					}
					else
					{
						for (int ip = i; ip < i + 10; ip++)
						{
							for (int jp = j; jp < j + 10; jp++)
							{
								c = bmp.GetPixel(ip, jp);
								bmp2.SetPixel(ip, jp, Color.FromArgb(c.R, c.G, c.B));
							}
						}
					}
				}
			}
			pictureBox2.Image = bmp2;
			ImagenCopia = bmp2;
		}

		private void button5_Click(object sender, EventArgs e)
		{
			ImagenCopia = (Bitmap)xImagenCopia.Clone();
			pictureBox2.Image = ImagenCopia;
			vec = "TT";
			richTextBox1.Text = vec;
		}

		private void button7_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}
				String query = "DELETE FROM Texturas_Activa WHERE id = @cIdx;";
				using (SqlCommand command = new SqlCommand(query, conn))
				{
					command.Parameters.AddWithValue("@cIdx", cIdx);

					int rowsAffected = command.ExecuteNonQuery();
					if (rowsAffected > 0)
					{
						MessageBox.Show("Eliminacion correcta." + cIdx);
					}
					else
					{
						MessageBox.Show("No encontrado ID." + cIdx);
					}
				}
				mostrar_Activa();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
			finally
			{
				if (conn.State == ConnectionState.Open)
				{
					conn.Close();
				}
			}
		}

		private void button8_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}
				String query = "DELETE FROM Texturas WHERE id = @cId;";
				using (SqlCommand command = new SqlCommand(query, conn))
				{
					command.Parameters.AddWithValue("@cId", cId);

					int rowsAffected = command.ExecuteNonQuery();
					if (rowsAffected > 0)
					{
						MessageBox.Show("Eliminacion correcta." + cId);
					}
					else
					{
						MessageBox.Show("No encontrado ID." + cId);
					}
				}
				mostrar();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
			finally
			{
				if (conn.State == ConnectionState.Open)
				{
					conn.Close();
				}
			}
		}

		private void button9_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				String query = "DELETE FROM Texturas_Activa;";
				using (SqlCommand command = new SqlCommand(query, conn))
				{
					int rowsAffected = command.ExecuteNonQuery();
					if (rowsAffected > 0)
					{
						MessageBox.Show("Eliminacion correcta todos los registros.");
					}
					else
					{
						MessageBox.Show("No se elimino nada.");
					}
				}
				mostrar_Activa();
			}
			catch (Exception ex)
			{
				MessageBox.Show("Ah Ocurrido un ERROR: " + ex.Message);
			}
			finally
			{
				if (conn.State == ConnectionState.Open)
				{
					conn.Close();
				}
			}
		}

		private void button10_Click(object sender, EventArgs e)
		{
			openFileDialog1.Filter = "archivos jpg|*.jpg";
			openFileDialog1.ShowDialog();
			Bitmap bmp2 = new Bitmap(openFileDialog1.FileName);
			pictureBox2.Image = bmp2;
			ImagenCopia = (Bitmap)bmp2.Clone();
			xImagenCopia = (Bitmap)(bmp2.Clone());
			vec = "TT";
		}

		private void button11_Click(object sender, EventArgs e)
		{
			if (ImagenCopia != null)
			{
				SaveFileDialog saveFileDialog1 = new SaveFileDialog();
				saveFileDialog1.Filter = "Image Files (*.jpg)|*.jpg";
				saveFileDialog1.Title = "Guardar imagen";
				if (saveFileDialog1.ShowDialog() == DialogResult.OK)
				{
					ImagenCopia.Save(saveFileDialog1.FileName);
					MessageBox.Show("Imagen guardada exitosamente");
				}
			}
			else
			{
				MessageBox.Show("No hay imagen para guardar");
			}
		}

		private void button12_Click(object sender, EventArgs e)
		{
			try
			{
				if (conn.State == ConnectionState.Closed)
				{
					conn.Open();
				}

				string query = "SELECT * FROM Texturas_Activa";
				SqlCommand command = new SqlCommand(query, conn);

				SqlDataReader reader = command.ExecuteReader();

				while (reader.Read())
				{
					int cId = Convert.ToInt32(reader["ID"]);
					string cNombre = reader["Nombre"].ToString();
					int cR = Convert.ToInt32(reader["R"]);
					int cG = Convert.ToInt32(reader["G"]);
					int cB = Convert.ToInt32(reader["B"]);
					string cColor = reader["Color"].ToString();
					textBox1.Text += $"{cNombre} {cR} {cG} {cB} {cColor}\n";
					Modificar(cId, cNombre, cR, cG, cB, cColor);
				}

				reader.Close();
				conn.Close();
				richTextBox1.Text = vec;
				//MessageBox.Show(vec);
			}
			catch (Exception ex)
			{
				MessageBox.Show("An error occurred: " + ex.Message);
			}

		}
	}
}
