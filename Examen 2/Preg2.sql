USE [master]
GO
/****** Object:  Database [TexturasDB]    Script Date: 09/06/2024 20:03:54 ******/
CREATE DATABASE [TexturasDB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'TexturasDB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\TexturasDB.mdf' , SIZE = 4160KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'TexturasDB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\TexturasDB_log.ldf' , SIZE = 1040KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [TexturasDB] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [TexturasDB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [TexturasDB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [TexturasDB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [TexturasDB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [TexturasDB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [TexturasDB] SET ARITHABORT OFF 
GO
ALTER DATABASE [TexturasDB] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [TexturasDB] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [TexturasDB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [TexturasDB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [TexturasDB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [TexturasDB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [TexturasDB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [TexturasDB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [TexturasDB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [TexturasDB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [TexturasDB] SET  ENABLE_BROKER 
GO
ALTER DATABASE [TexturasDB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [TexturasDB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [TexturasDB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [TexturasDB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [TexturasDB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [TexturasDB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [TexturasDB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [TexturasDB] SET RECOVERY FULL 
GO
ALTER DATABASE [TexturasDB] SET  MULTI_USER 
GO
ALTER DATABASE [TexturasDB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [TexturasDB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [TexturasDB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [TexturasDB] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [TexturasDB]
GO
/****** Object:  Table [dbo].[Texturas]    Script Date: 09/06/2024 20:03:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Texturas](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Nombre] [varchar](50) NOT NULL,
	[R] [int] NOT NULL,
	[G] [int] NOT NULL,
	[B] [int] NOT NULL,
	[Color] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Texturas_Activa]    Script Date: 09/06/2024 20:03:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Texturas_Activa](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Nombre] [varchar](50) NOT NULL,
	[R] [int] NOT NULL,
	[G] [int] NOT NULL,
	[B] [int] NOT NULL,
	[Color] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Texturas] ON 

INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (1, N'lana', 199, 177, 154, N'green')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (2, N'cuello', 81, 69, 57, N'white')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (3, N'sombras', 141, 125, 107, N'red')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (5, N'texsfsd', 204, 182, 158, N'blue')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (6, N'fondo', 255, 255, 255, N'black')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (1004, N'cafe', 137, 117, 96, N'Red')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (2004, N'sadas', 109, 141, 146, N'red')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (3004, N'tierra', 176, 178, 161, N'Purple')
INSERT [dbo].[Texturas] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (3005, N'techo', 248, 156, 138, N'yellow')
SET IDENTITY_INSERT [dbo].[Texturas] OFF
SET IDENTITY_INSERT [dbo].[Texturas_Activa] ON 

INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (1002, N'cafe', 137, 117, 96, N'Red')
INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (2002, N'texsfsd', 204, 182, 158, N'blue')
INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (2003, N'fondo', 255, 255, 255, N'black')
INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (2004, N'sadas', 109, 141, 146, N'red')
INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (3004, N'tierra', 176, 178, 161, N'Purple')
INSERT [dbo].[Texturas_Activa] ([ID], [Nombre], [R], [G], [B], [Color]) VALUES (3006, N'techo2', 226, 167, 150, N'Yellow')
SET IDENTITY_INSERT [dbo].[Texturas_Activa] OFF
USE [master]
GO
ALTER DATABASE [TexturasDB] SET  READ_WRITE 
GO
