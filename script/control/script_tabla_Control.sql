USE [SecureLogin]
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_Cookie'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_TipoHash'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_MetodoEncriptacion'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveIv'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveInicial'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_IdEstado'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveAcceso'
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_IdControl'
GO

/****** Object:  Table [dbo].[Control]    Script Date: 06/06/2021 1:10:05 a. m. ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Control]') AND type in (N'U'))
DROP TABLE [dbo].[Control]
GO

/****** Object:  Table [dbo].[Control]    Script Date: 06/06/2021 1:10:05 a. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Control](
	[CON_IdControl] [int] IDENTITY(1,1) NOT NULL,
	[CON_LlaveAcceso] [nchar](500) NULL,
	[CON_IdEstado] [int] NULL,
	[CON_LlaveInicial] [nchar](50) NULL,
	[CON_LlaveIv] [nchar](50) NULL,
	[CON_MetodoEncriptacion] [nchar](50) NULL,
	[CON_TipoHash] [nchar](20) NULL,
	[CON_Cookie] [nchar](50) NULL,
 CONSTRAINT [PK_control] PRIMARY KEY CLUSTERED 
(
	[CON_IdControl] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Id' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_IdControl'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Llave de Acceso' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveAcceso'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Estado' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_IdEstado'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Llave inicial' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveInicial'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Verificado de Llae' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_LlaveIv'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Metodo de Cifrado' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_MetodoEncriptacion'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Tipo de hash a usar' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_TipoHash'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Manejo de cookies' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Control', @level2type=N'COLUMN',@level2name=N'CON_Cookie'
GO

