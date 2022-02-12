import React, { useEffect, useRef, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Spin,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle, Scan } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";
import ReactToPrint, { useReactToPrint } from "react-to-print";
import { PrintTankBarcodes } from "@/Pages/Print/PrintTankBarcodes";
import { handleError } from "@/Helpers/handleError";
import axios from "axios";

const Tank = ({
  loading,
  dataSource,
  filters,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const [selectedRowKeys, setSelectedRowKeys] = useState([]);
  const [barcodes, setBarcodes] = useState([]);
  const [printLoading, setPrintLoading] = useState(false);
  const [cancelTokenSource, setCancelTokenSource] = useState(
    axios.CancelToken.source()
  );

  console.log(filters);

  const columns = [
    {
      title: "Kategori Tabung",
      dataIndex: "category_name",
      key: "category",
      sorter: true,
      filters: filters && filters["categories"],
    },
    {
      title: "No. Tabung",
      dataIndex: "serial_number",
      key: "serial_number",
      sorter: true,
    },
    {
      title: "Lokasi",
      dataIndex: "location",
      key: "location",
      sorter: true,
      filters: filters && filters["locations"],
    },
    {
      title: "Status",
      dataIndex: "status",
      key: "status",
      sorter: true,
      filters: filters && filters["status"],
    },
    {
      title: "Informasi Tambahan",
      dataIndex: "note",
      key: "note",
      sorter: true,
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Lihat Barcode">
            <a href={route(routes.TANKS_BARCODE, record.id)} target="_blank">
              <Button
                type="default"
                icon={
                  <Scan size="medium" set="curved" className="remix-icon" />
                }
              />
            </a>
          </Popover>
          <Popover content="Edit">
            <Link href={route(routes.TANKS_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title: 'Hapus tabung dengan nomor "' + data.serial_number + '"?',
      icon: <InfoCircle className="remix-icon" />,
      content: "Data tabung ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.TANKS_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  const handleSelectChange = (values) => {
    setSelectedRowKeys(values);
  };

  const printRef = useRef();

  useEffect(() => {
    return () => {
      cancelTokenSource.cancel();
    };
  }, []);

  const handleClickPrint = () => {
    setPrintLoading(true);
    axios
      .get(route(routes.TANKS_AJAX_PRINT_BARCODES), {
        params: { id: selectedRowKeys },
        cancelToken: cancelTokenSource.token,
      })
      .then((res) => {
        setBarcodes(res.data);
        handlePrint();
      })
      .catch((err) => handleError(err))
      .finally(() => setPrintLoading(false));
  };

  const handleAfterPrint = () => {
    setBarcodes([]);
  };

  const handlePrint = useReactToPrint({
    content: () => printRef.current,
    removeAfterPrint: true,
    onAfterPrint: handleAfterPrint,
  });

  return (
    <React.Fragment>
      <Spin spinning={printLoading}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs breadcrumbs={[{ name: "Data Tabung" }]} />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Data Tabung</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Row justify="space-between" className="da-w-100">
                  <Col>
                    <Input placeholder="Search ..." onChange={handleSearch} />
                  </Col>
                  <Col>
                    <Space>
                      <Button type="default" onClick={handleClickPrint}>
                        Print Barcode Tabung (
                        {selectedRowKeys.length > 0
                          ? selectedRowKeys.length
                          : "Semua"}
                        )
                      </Button>
                      <div style={{ display: "none" }}>
                        <PrintTankBarcodes ref={printRef} images={barcodes} />
                      </div>

                      <Button type="primary">
                        <Link href={route(routes.TANKS_CREATE)}>Create</Link>
                      </Button>
                    </Space>
                  </Col>
                </Row>

                <Col span={24}>
                  <Table
                    rowKey="id"
                    columns={columns}
                    dataSource={dataSource}
                    pagination={pagination}
                    loading={loading}
                    onChange={handleChangeTable}
                    rowSelection={{
                      selectedRowKeys,
                      onChange: handleSelectChange,
                    }}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Spin>
    </React.Fragment>
  );
};

export default withTable(Tank, {
  routeAjaxIndex: routes.TANKS_AJAX_INDEX,
});
